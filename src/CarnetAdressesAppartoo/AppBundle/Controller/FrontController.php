<?php

namespace CarnetAdressesAppartoo\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Model\UserInterface;


/**
 * Contrôleur principal de l'application.
 */
class FrontController extends Controller {
    
    public function indexAction() {
        $user = $this->getUser();
        
        if (!is_object($user) || !$user instanceof UserInterface) {
            return new RedirectResponse($this->generateUrl('fos_user_security_login'));
        }
        
        return $this->forward('CarnetAdressesAppartooAppBundle:Front:profile', array('username' => $user->getUsername()));
    }
    
    public function profileAction($username) {
        $user = $this->get('fos_user.user_manager')->findUserBy(array('username' => $username));

        if (!$user) {
            throw new NotFoundHttpException("Aucun utilisateur ne correspond à $username.");
        }
        
        $request = $this->get('request_stack')->getCurrentRequest();
        
        if ($request->isMethod('post')) {
            return $this->forward('CarnetAdressesAppartooAppBundle:Profile:add', array('request' => $request, 'user' => $user));
        }

        return $this->forward('CarnetAdressesAppartooAppBundle:Profile:show', array('user' => $user));
    }
    
    public function contactsAction() {
        $request = $this->get('request_stack')->getCurrentRequest();
        
        if ($request->isMethod('post')) {
            return $this->forward('CarnetAdressesAppartooAppBundle:Contacts:delete', array('request' => $request));
        }
        
        return $this->forward('CarnetAdressesAppartooAppBundle:Contacts:show');
    }
    
    public function searchAction() {
        $request = $this->get('request_stack')->getCurrentRequest();
        
        if ($request->isMethod('post')) {
            return $this->forward('CarnetAdressesAppartooAppBundle:Search:search', array('request' => $request));
        }
        
        return $this->forward('CarnetAdressesAppartooAppBundle:Search:show');
    }

}