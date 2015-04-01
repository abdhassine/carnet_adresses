<?php

namespace CarnetAdresses\AppBundle\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Routing\Router;
use Symfony\Component\Translation\Exception\NotFoundResourceException;


class ListingController {
    private $em;
    private $templating;
    private $formFactory;
    private $router;
    
    
    public function __construct(EntityManager $em, EngineInterface $templating, FormFactory $formFactory, Router $router) {
        $this->em = $em;
        $this->templating = $templating;
        $this->formFactory = $formFactory;
        $this->router = $router;
    }


    public function viewAction($username) {
        $userRepo = $this->em->getRepository('CarnetAdressesUserBundle:User');
        $owner = $userRepo->findOneBy(array('username' => $username));
        
        $abRepo = $this->em->getRepository('CarnetAdressesUserBundle:AddressBook');
        $addressBook = $abRepo->findAddressBookOf($owner);
        
        if (!$addressBook) {
            return $this->templating->renderResponse('CarnetAdressesAppBundle:Front:listing.html.twig',
                array(
                    'contacts' => array(),
            ));
        }
        
        return $this->templating->renderResponse('CarnetAdressesAppBundle:Front:listing.html.twig',
                array(
                    'contacts' => $addressBook->getContacts(),
            ));
    }
    
    
    public function deleteAction($username, array $ids) {
        $userRepo = $this->em->getRepository('CarnetAdressesUserBundle:User');
        $abRepo = $this->em->getRepository('CarnetAdressesUserBundle:AddressBook');
        
        $owner = $userRepo->findBy($username);
        $addressBook = $abRepo->findBy($owner);
        
        foreach ($ids as $id) {
            $user = $userRepo->find($id);
            
            if (!$user) {
                throw new NotFoundResourceException("Pas de contact d'Id $id");
            }
            
            $addressBook->removeContact($user);
        }
        
        $this->em->persist($addressBook);
        $this->em->flush();
        
        return new RedirectResponse($this->router->generate('carnet_app_listing'));
    }

}


