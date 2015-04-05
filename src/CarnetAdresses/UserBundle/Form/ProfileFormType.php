<?php

namespace CarnetAdresses\UserBundle\Form;

use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class ProfileFormType extends BaseType {
    
    public function __construct($class) {
        parent::__construct($class);
    }
    

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        $builder->add('firstname', 'text', array('required' => true))
                ->add('surname', 'text', array('required' => true))
                ->add('address', 'text', array('required' => false))
                ->add('phonenumber', 'text', array('required' => false))
                ->add('siteweb', 'url', array('required' => false));
    }
    
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        parent::setDefaultOptions($resolver);
    }

    
    /**
     * @return string
     */
    public function getName() {
        return 'carnetadresses_userbundle_profile';
    }

}
