<?php

namespace CarnetAdresses\UserBundle\Form;

use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class RegistrationFormType extends BaseType {
    
    public function buildForm(FormBuilder $builder, array $options) {
        parent::buildForm($builder, $options);
        
        $builder->add('firstname', 'text')
                ->add('surname', 'text')
                ->add('address', 'text')
                ->add('phonenumber', 'number')
        ;
    }
    
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        parent::setDefaultOptions($resolver);
    }
    
    
    public function getName() {
        return 'carnetadresses_userbundle_registration';
    }
}