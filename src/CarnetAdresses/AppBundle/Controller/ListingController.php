<?php

namespace CarnetAdresses\AppBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

use CarnetAdresses\UserBundle\Form\UserItemListType;
use CarnetAdresses\UserBundle\Entity\User;
use CarnetAdresses\UserBundle\Entity\AddressBook;


class ListingController extends ContainerAware {
   
    public function listingAction($username) {
        $em = $this->container->get('doctrine')->getManager();
        $userRepo = $em->getRepository('CarnetAdressesUserBundle:User');
        
        $user = $userRepo->findOneBy(array('username' => $username));
        if (!$user) {
            throw new NotFoundResourceException("Aucun User ne correspond à $username.");
        }
        
        $abRepo = $em->getRepository('CarnetAdressesUserBundle:AddressBook');
        $book = $abRepo->findAddressBookOf($user);
        $contacts = ($book) ? $book->getContacts() : null;
       
        if (!$contacts) {
            return $this->container->get('templating')
                    ->renderResponse('CarnetAdressesAppBundle:Front:listing.html.twig', array(
                        'username'      => $username,
                        'contactsForm'  => null,
                    ));
        }
        
        return $this->contactFormAction($contacts, $book);
    }
    
    
    private function contactFormAction(Collection $contacts, AddressBook $book) {
        $em = $this->container->get('doctrine')->getManager();
        $userRepo = $em->getRepository('CarnetAdressesUserBundle:User');

        $contactIds = array();
        foreach ($contacts as $contact) {
            $contactIds[] = $contact->getId();
        }
        
        $qb = $userRepo->createQueryBuilder('u')->where('u.id IN (:ids)')->setParameter('ids', $contactIds);
        
        $contactsForm = $this->container->get('form.factory')->create(new UserItemListType($qb));
        $request = $this->container->get('request_stack')->getCurrentRequest();
        
        return $this->deleteSelectionAction($contactsForm, $request, $book);
    }
    
    
    private function deleteSelectionAction(Form $contactsForm, Request $request, AddressBook $book) {
        $em = $this->container->get('doctrine')->getManager();
        $userRepo = $em->getRepository('CarnetAdressesUserBundle:User');
        
        $options = $contactsForm->get('user')->getConfig()->getOptions();
        $choices = $options['choice_list']->getChoices();
        
        if ($request->getMethod() == 'POST') {
            $contactsForm->handleRequest($request);
            
            if ($contactsForm->isValid()) {
                $ids = $request->get($contactsForm->getName());
                
                foreach ($ids as $id) {
                    $contact = $userRepo->find($id);
                    $book->removeContact($contact);
                }
                
                $em->persist($book);
                $em->flush();
                
                return new RedirectResponse($this->container->get('router')
                        ->generate('carnet_app_listing', array(
                            'username' => $book->getOwner()->getUsername(),
                        )));
            }
        }
        
        return $this->container->get('templating')
                ->renderResponse('CarnetAdressesAppBundle:Front:listing.html.twig', array(
                    'username'     => $book->getOwner()->getUsername(),
                    'contactsForm' => $contactsForm->createView(),
                    'choices'      => $choices,
                ));
    }
    
}
