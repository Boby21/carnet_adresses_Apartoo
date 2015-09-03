<?php

namespace CarnetAdressesAppartoo\AppBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;
use CarnetAdressesAppartoo\UserBundle\Entity\User;


/**
 * Contrôleur de la page de profil des utilisateur autre que l'utlisateur connecté.
 */
class ProfileController extends ContainerAware {

    public function showAction(User $user) {
        $userSession = $this->container->get('security.context')->getToken()->getUser();
        
        if ($user->getUsername() == $userSession->getUsername()) {
            $url = $this->container->get('router')->generate('fos_user_profile_show');
            return new RedirectResponse($url);
        }
        
        $em = $this->container->get('doctrine')->getManager();
        $book = $em->getRepository('CarnetAdressesAppartooAppBundle:AddressBook')->findAddressBookOf($userSession);
        $isContact = $book->contains($user);
        
        $view = 'CarnetAdressesAppartooAppBundle:Front:profile.html.twig';
        return $this->container->get('templating')->renderResponse($view, array(
            'user' => $user, 
            'isContact' => $isContact
        ));
    }
    
    public function addAction(Request $request, User $user) {
        $userSession = $this->container->get('security.context')->getToken()->getUser();
        $em = $this->container->get('doctrine')->getManager();
        $book = $em->getRepository('CarnetAdressesAppartooAppBundle:AddressBook')->findAddressBookOf($userSession);
        $book->addContact($user);
        $em->persist($book);
        $em->flush();
        
        $session = $request->getSession();
        $session->getFlashBag()->add('confirmation', $user->getUsername().' est maintenant votre ami(e).');
        
        return new RedirectResponse($this->container->get('router')->generate('carnet_app_profile', array(
            'username' => $user->getUsername()
        )));
    }
	
}