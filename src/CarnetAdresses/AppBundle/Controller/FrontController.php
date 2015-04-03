<?php

namespace CarnetAdresses\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class FrontController extends Controller {

    public function indexAction() {
        return $this->forward('CarnetAdressesAppBundle:Index:view');
    }
    
    
    public function profilAction($username) {
       return $this->forward('CarnetAdressesAppBundle:Profil:profil', array('username' => $username));
    }
    
    
    public function ajouterAction($username) {
        
    }
    
    
    public function listingAction($username) {
    
    }
    
    
    public function logoutAction($username) {
        
    }

}
