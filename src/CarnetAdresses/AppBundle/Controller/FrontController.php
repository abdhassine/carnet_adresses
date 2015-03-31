<?php

namespace CarnetAdresses\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class FrontController extends Controller {

    public function indexAction() {
       $controller = new IndexController(
               $this->getDoctrine()->getEntityManager(), 
               $this->get('templating'),
               $this->get('form.factory'),
               $this->get('router')
        );
       
       return $controller->viewAction();
    }
    
    
    public function profilAction($username) {
        $controller = new ProfilController(
                $this->getDoctrine()->getEntityManager(), 
                $this->get('templating'),
                $this->get('router')
        );
        
        return $controller->viewAction($username);
    }
    
    
    public function ajouterAction($username) {
        
    }
    
    
    public function listingAction($username) {
        $controller = new ListingController(
               $this->getDoctrine()->getEntityManager(), 
               $this->get('templating'),
               $this->get('form.factory'),
               $this->get('router')
        );
        
        return $controller->viewAction($username);
    }
    
    
    public function logoutAction($username) {
        
    }

}
