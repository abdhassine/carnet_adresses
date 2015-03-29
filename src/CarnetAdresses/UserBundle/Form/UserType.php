<?php

namespace CarnetAdresses\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class UserType extends AbstractType {
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options = null) {
        $builder
            ->add('firstname', 'text')
            ->add('surname', 'text')
            ->add('email', 'email')
            ->add('username', 'text')
            ->add('password', 'password')
            ->add('siteweb', 'url')
            ->add('S\'inscrire', 'submit')
        ;
    }
    
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'CarnetAdresses\UserBundle\Entity\User'
        ));
    }

    
    /**
     * @return string
     */
    public function getName() {
        return 'carnetadresses_userbundle_user';
    }
}
