<?php

namespace CarnetAdresses\AppBundle\Controller\Api;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use CarnetAdresses\UserBundle\Entity\User;


class ContactsRestController extends FOSRestController {
    
    public function getContactsAction() {
        $user = $this->container->get('security.context')->getToken()->getUser();
        
        if (!is_object($user) || !$user instanceof User) {
            throw new NotFoundHttpException('User not connected');
        }
        
        $contacts = $this->container->get('carnet_adresses_app.contacts_handler')->getContactsOf($user);
        
        return array('contacts' => $contacts);
    }
   
    
    public function removeContactAction($username) {
        $user = $this->container->get('security.context')->getToken()->getUser();
        
        if (!is_object($user) || !$user instanceof User) {
            throw new NotFoundHttpException('User not connected');
        }
        
        
        $contact = $this->container->get('fos_user.user_manager')->findUserBy(array('username' => $username));
        
        if (!$contact) {
            throw new NotFoundHttpException('No user found');
        }
        
        $this->container->get('carnet_adresses_app.contacts_handler')->deleteContact($username, $user);
    }
    
    
    public function addContactAction($username) {
        $user = $this->container->get('security.context')->getToken()->getUser();
        
        if (!is_object($user) || !$user instanceof User) {
            throw new AccessDeniedException('Access denied');
        }
        
        $this->container->get('carnet_adresses.contacts_handler')->addContact($username, $user);
    }
}
