<?php

namespace CarnetAdresses\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * AsdressBook
 *
 * @ORM\Table(name="addressbook_table")
 * @ORM\Entity(repositoryClass="CarnetAdresses\UserBundle\Entity\AddressBookRepository")
 */
class AddressBook {
    /**
     * @ORM\Id
     * @ORM\Column(name="id_addressbook", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="id_owner", referencedColumnName="id_user", nullable=false)
     */
    private $owner;
    
    /**
     * @ORM\ManyToMany(targetEntity="User")
     * @ORM\JoinTable(name="address_contacts_table",
     *          joinColumns={@ORM\JoinColumn(name="id_addressbook", referencedColumnName="id_addressbook")},
     *          inverseJoinColumns={@ORM\JoinColumn(name="id_contact", referencedColumnName="id_user")}
     * )
     */
    private $contacts;
    
    
    public function __construct(User $owner) {
        $this->owner = $owner;
        $this->contacts = new ArrayCollection();
    }

    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }
    
    
    /**
     * Set owner
     *
     * @param User $owner
     * @return AddressBook
     */
    public function setOwner(User $owner) {
        $this->owner = $owner;
        return $this;
    }

    /**
     * Get owner
     *
     * @return User 
     */
    public function getOwner() {
        return $this->owner;
    }
    

    /**
     * Add contacts
     *
     * @param User $contact
     * @return AddressBook
     */
    public function addContact(User $contact) {
        $this->contacts[] = $contact;
        return $this;
    }

    /**
     * Remove contacts
     *
     * @param User $contact
     */
    public function removeContact(User $contact) {
        $this->contacts->removeElement($contact);
    }

    /**
     * Get contacts
     *
     * @return ArrayCollection 
     */
    public function getContacts() {
        return $this->contacts;
    }

}
