<?php

namespace CarnetAdresses\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

use CarnetAdresses\UserBundle\Entity\User;


/**
 * AsdressBook
 *
 * @ORM\Table(name="addressbook_table")
 * @ORM\Entity(repositoryClass="CarnetAdresses\AppBundle\Entity\AddressBookRepository")
 * @ExclusionPolicy("all")
 */
class AddressBook {
    /**
     * @ORM\Id
     * @ORM\Column(name="id_addressbook", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\OneToOne(targetEntity="CarnetAdresses\UserBundle\Entity\User", cascade={"remove"})
     * @ORM\JoinColumn(name="id_owner", referencedColumnName="id_user", nullable=false)
     * @Expose
     */
    private $owner;
    
    /**
     * @ORM\ManyToMany(targetEntity="CarnetAdresses\UserBundle\Entity\User", cascade={"remove"})
     * @ORM\JoinTable(name="address_contacts_table",
     *          joinColumns={@ORM\JoinColumn(name="id_addressbook", referencedColumnName="id_addressbook")},
     *          inverseJoinColumns={@ORM\JoinColumn(name="id_contact", referencedColumnName="id_user")}
     * )
     * @Expose
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
    
    /**
     * Renvoie le contact dont l'Id correspond à l'Id spécifié en paramètre.
     * Si l'Id ne correspond à aucun contact, renvoie null. 
     * @param type $id
     * @return User or null
     */
    public function getContact($id) {
        foreach($this->contacts as $contact) {
            if ($contact->getId() === $id) {
                return $contact;
            }
        }
        return null;
    }
    
    
    public function isEmpty() {
        return $this->contacts->isEmpty();
    }
    
    
    public function contains(User $user) {
        return $this->contacts->contains($user);
    }

}
