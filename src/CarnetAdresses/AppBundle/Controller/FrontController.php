<?php

namespace CarnetAdresses\AppBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;


class FrontController extends ContainerAware {

    public function indexAction() {
       $controller = new IndexController(
               $this->container->get('doctrine')->getEntityManager(), 
               $this->container->get('templating'),
               $this->container->get('form.factory'),
               $this->container->get('router')
        );
       
       return $controller->viewAction();
    }
    
    
    public function profilAction($username) {
        $controller = new ProfilController(
                $this->container->get('doctrine')->getEntityManager(), 
                $this->container->get('templating'),
                $this->container->get('router')
        );
        
        return $controller->viewAction($username);
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
