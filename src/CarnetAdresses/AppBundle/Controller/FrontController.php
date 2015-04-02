<?php

namespace CarnetAdresses\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class FrontController extends Controller {

    public function indexAction() {
        return $this->forward('CarnetAdressesAppBundle:Index:view');
    }
    
    
    public function profilAction($username) {
       $response = $this->forward('CarnetAdressesAppBundle:Index:view');
       return $response;
    }
    
    
    public function ajouterAction($username) {
        
    }
    
    
    public function listingAction($username) {
        $controller = new ListingController(
               $this->container->get('doctrine')->getEntityManager(), 
               $this->container->get('templating'),
               $this->container->get('form.factory'),
               $this->container->get('router')
        );
        
        return $controller->viewAction($username);
    }
    
    
    public function logoutAction($username) {
        
    }

}
