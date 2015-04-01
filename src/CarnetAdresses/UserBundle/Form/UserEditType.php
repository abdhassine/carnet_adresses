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
        $builder->remove('emailconfirm')
                ->remove('subscribe')
                ->add('oldpassword', 'password')
                ->add('siteweb', 'url')
                ->add('edit', 'submit')
        ;
    }

    
    /**
     * @return string
     */
    public function getName() {
        return 'carnetadresses_userbundle_useredit';
    }
}


