<?php

namespace CarnetAdresses\AppBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Repository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\Common\Collections\ArrayCollection;

use CarnetAdresses\UserBundle\Entity\User;


class ContactsHandler {
    /** @var ObjectManager */
    private $om;
    
    /** @var string */
    private $entityClass;
    
    /** @var Repository */
    private $repository;
    
    
    public function __construct(ObjectManager $om, $entityClass) {
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($entityClass);
    }
    
    
    public function getContactsOf(User $user) {
        $addressBook = $this->repository->findAddressBookOf($user);
        
        $contacts = new ArrayCollection();
        foreach ($addressBook->getContacts() as $contact) {
            $data = $this->om->getRepository('CarnetAdressesUserBundle:User')->getUserData($contact->getUsername());
            $contacts->add($data);
        }
        
        return $contacts;
    }
    
    
    public function deleteContact($username, User $user) {
        $addressBook = $this->repository->findAddressBookOf($user);
        $contact = $this->om->getRepository('CarnetAdressesUserBundle:User')->findOneBy(array('username' => $username));
        
        if (!$addressBook->contains($contact)) {
            throw new NotFoundHttpException('This contact is not in your address book');
        }
        
        $addressBook->removeContact($contact);
        $this->om->persist($addressBook);
        $this->om->flush();
    }
    
    
    public function addContact($username, User $user) {
        $addressBook = $this->repository->findAddressBookOf($user);
        $contact = $this->om->getRepository('CarnetAdressesUserBundle:User')->findOneBy(array('username' => $username));
        
        if (!$contact) {
            throw new NotFoundHttpException('No user found');
        }
        
        $addressBook->addContact($contact);
        $this->om->persist($addressBook);
        $this->om->flush();
    }
}
