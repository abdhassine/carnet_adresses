<?php

namespace CarnetAdresses\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class FrontController extends Controller {

    public function indexAction() {
        return $this->forward('CarnetAdressesAppBundle:Index:index');
    }
    
    
    public function profilAction($username) {
       return $this->forward('CarnetAdressesAppBundle:Profil:profil', array('username' => $username));
    }
    
    
    public function ajouterAction($username) {
        return $this->forward('CarnetAdressesAppBundle:Ajouter:ajouter', array('username' => $username));
    }
    
    
    public function listingAction($username) {
        return $this->forward('CarnetAdressesAppBundle:Listing:listing', array('username' => $username));
    }

}
