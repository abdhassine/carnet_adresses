<?php

namespace CarnetAdresses\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class SearchFormType extends AbstractType { 
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('username', 'text', array('required' => false, 'label' => 'Pseudo du profil'))
                ->add('email', 'email', array('required' => false, 'label' => 'Adresse e-mail'))
                ->add('firstname', 'text', array('required' => false, 'label' => 'Prénom'))
                ->add('surname', 'text', array('required' => false, 'label' => 'Nom de famille'))
                ->add('address', 'text', array('required' => false, 'label' => 'Adresse postale'))
                ->add('phonenumber', 'text', array('required' => false, 'label' => 'Numéro de téléphone'))
        ;
    }

    
    /**
     * @return string
     */
    public function getName() {
        return 'carnetadresses_appbundle_search';
    }
}
