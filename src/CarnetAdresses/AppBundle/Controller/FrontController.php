<?php

namespace CarnetAdresses\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class FrontController extends Controller {

    public function indexAction() {
       $response = $this->forward('CarnetAdressesAppBundle:Index:viewAction');
       return $response;
    }
    
    
    public function profilAction($username) {
       $response = $this->forward('CarnetAdressesAppBundle:Profil:viewAction',
               array('username' => $username));
       return $response;
    }
    
    
    public function ajouterAction() {
        
    }
    
    
    public function listingAction() {
        
    }
    
    
    public function logoutAction() {
        
    }

}
