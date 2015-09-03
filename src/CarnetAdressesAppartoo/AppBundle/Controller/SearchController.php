<?php

namespace CarnetAdressesAppartoo\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerAware;
use CarnetAdressesAppartoo\AppBundle\Form\SearchFormType;


/**
 * Contrôleur de la page de recherche de membres.
 */
class SearchController extends ContainerAware {
    
    public function showAction() {
        $form = $this->container->get('form.factory')->create(new SearchFormType);

        return $this->container->get('templating')
                    ->renderResponse('CarnetAdressesAppartooAppBundle:Front:search.html.twig', array(
                        'form' => $form->createView(),
        ));
    }

    public function searchAction(Request $request) {
        $form = $this->container->get('form.factory')->create(new SearchFormType);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $em = $this->container->get('doctrine')->getManager();
            $rawData = $form->getData();
            
            $data = array();
            foreach ($rawData as $key => $dataItem) {
                if ($dataItem) {
                    $data[$key] = $dataItem;
                }
            }

            if (!empty($data)) {
                $results = $em->getRepository('CarnetAdressesAppartooUserBundle:User')->findBy($data);
            } else {
                $results = null;
            }
            
            return $this->container->get('templating')
                    ->renderResponse('CarnetAdressesAppartooAppBundle:Front:result.html.twig', array(
                        'users' => $results,
                        'data'  => $data,
                    ));
        }
    }

}