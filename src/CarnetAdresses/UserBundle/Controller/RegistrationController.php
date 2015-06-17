<?php

namespace CarnetAdresses\UserBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\Response;
use FOS\UserBundle\Controller\RegistrationController as BaseController;

use CarnetAdresses\AppBundle\Entity\AddressBook;


class RegistrationController extends BaseController {
    
    public function authenticateUser(UserInterface $user, Response $response) {
        parent::authenticateUser($user, $response);
        
        $em = $this->container->get('doctrine')->getManager();
        $book = new AddressBook($user);
        $em->persist($book);
        $em->flush();
    }
}