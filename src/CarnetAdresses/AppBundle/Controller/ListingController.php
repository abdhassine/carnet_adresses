<?php

namespace CarnetAdresses\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class ListingController extends Controller {

    public function viewAction($username) {
        $repository = $this->getDoctrine()->getManager()
                ->getRepository('CarnetAdressesUserBundle:AdressBook');
        $contacts = $repository->findAllContactsOf($username);
        $content = $this->get('templating')->render('CarnetAdressesAppBundle:Front:listing.html.twig',
                array('contacts' => $contacts));
        
        return new Response($content);
    }
    
    
    public function deleteAction() {
        $em = $this->getDoctrine()->getManager();
    }

}


