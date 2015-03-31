<?php

namespace CarnetAdresses\AppBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\Translation\Exception\NotFoundResourceException;


class ListingController extends ContainerAware {

    public function viewAction($username) {
        $repository = $this->container->get('doctrine')->getManager()
                ->getRepository('CarnetAdressesUserBundle:AdressBook');
        $contacts = $repository->findAllContactsOf($username);
        $content = $this->get('templating')->renderResponse('CarnetAdressesAppBundle:Front:listing.html.twig',
                array('contacts' => $contacts));
        
        return new $content;
    }
    
    
    public function deleteAction($username, array $ids) {
        $em = $this->container->get('doctrine')->getManager();
        $userRepo = $em->getRepository('CarnetAdressesUserBundle:User');
        $abRepo = $em->getRepository('CarnetAdressesUserBundle:AddressBook');
        
        $owner = $userRepo->findBy($username);
        $addressBook = $abRepo->findBy($owner);
        
        foreach ($ids as $id) {
            $user = $userRepo->find($id);
            
            if (!$user) {
                throw new NotFoundResourceException("Pas de contact d'Id $id");
            }
            
            $addressBook->removeContact($user);
        }
        
        $em->persist($addressBook);
        $em->flush();
        
        return new RedirectResponse($this->container->get('router')->generate('carnet_app_listing'));
    }

}


