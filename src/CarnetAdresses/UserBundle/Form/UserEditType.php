<?php

namespace CarnetAdresses\UserBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;


class UserEditType extends UserType {
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        $builder->add('oldpassword', 'password')
                ->add('siteweb', 'url')
        ;
    }

    
    /**
     * @return string
     */
    public function getName() {
        return 'carnetadresses_userbundle_useredit';
    }
}


