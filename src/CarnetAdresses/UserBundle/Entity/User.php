<?php
// src/CarnetAdresses/UserBundle/Entity/User.php

namespace CarnetAdresses\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="CarnetAdresses\UserBundle\Entity\UserRepository")
 * @ORM\Table(name="user_table")
 */
class User extends BaseUser {
    /**
     * @ORM\Id
     * @ORM\Column(name="id_user", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(name="firstname", type="string", length=30, nullable=false)
     */
    private $firstname;
    
    /**
     * @ORM\Column(name="surname", type="string", length=30, nullable=false)
     */
    private $surname;

    /**
     * @ORM\Column(name="siteweb", type="string", nullable=true)
     */
    private $siteweb = null;
    

    public function __construct() {
        parent::__construct();
        $this->addressBook = new AddressBook();
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
     * Set siteweb
     *
     * @param string $siteweb
     * @return User
     */
    public function setSiteweb($siteweb) {
        $this->siteweb = $siteweb;
        return $this;
    }

    /**
     * Get siteweb
     *
     * @return string 
     */
    public function getSiteweb() {
        return $this->siteweb;
    }
    

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname) {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname() {
        return $this->firstname;
    }

    
    /**
     * Set surname
     *
     * @param string $surname
     * @return User
     */
    public function setSurname($surname) {
        $this->surname = $surname;
        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname() {
        return $this->surname;
    }
}
