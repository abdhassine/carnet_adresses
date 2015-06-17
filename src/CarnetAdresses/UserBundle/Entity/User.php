<?php
// src/CarnetAdresses/UserBundle/Entity/User.php

namespace CarnetAdresses\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;


/**
 * @ORM\Entity(repositoryClass="CarnetAdresses\UserBundle\Entity\UserRepository")
 * @ORM\Table(name="user_table")
 * @ExclusionPolicy("all")
 */
class User extends BaseUser implements EquatableInterface {
    /**
     * @ORM\Id
     * @ORM\Column(name="id_user", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(name="firstname", type="string", length=30, nullable=false)
     * @Expose
     */
    private $firstname;
    
    /**
     * @ORM\Column(name="surname", type="string", length=30, nullable=false)
     * @Expose
     */
    private $surname;
    
    /**
     * @ORM\Column(name="address", type="string", nullable=true)
     * @Expose
     */
    private $address;
    
    /**
     * @ORM\Column(name="phonenumber", type="string", length=10, nullable=true)
     * @Expose
     */
    private $phonenumber;

    /**
     * @ORM\Column(name="siteweb", type="string", nullable=true)
     * @Expose
     */
    private $siteweb = null;
    

    public function __construct() {
        parent::__construct();
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

    
    /**
     * Set address
     *
     * @param string $address
     * @return User
     */
    public function setAddress($address) {
        $this->address = $address;
        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress() {
        return $this->address;
    }

    
    /**
     * Set phonenumber
     *
     * @param string $phonenumber
     * @return User
     */
    public function setPhonenumber($phonenumber) {
        $this->phonenumber = $phonenumber;
        return $this;
    }

    /**
     * Get phonenumber
     *
     * @return string 
     */
    public function getPhonenumber() {
        return $this->phonenumber;
    }
    
    
    /**
     * Renvoie une représentation du User sous forme de string.
     * 
     * @return string
     */
    public function __toString() {
        $str = parent::__toString().' ';
        $str .= $this->email.' '
             .$this->firstname.' '.$this->surname;
        return (string)$str;
    }
    
    
    public function isEqualTo(UserInterface $user) {
        if ($this->username !== $user->getUsername()) {
            return false;
        }
        
        if ($this->password !== $user->getPassword()) {
            return false;
        }
        
        return true;
    }
}
