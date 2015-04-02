<?php

namespace CarnetAdresses\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use CarnetAdresses\UserBundle\Entity\AddressBookRepository;


class AddressBookType extends AbstractType {
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('contacts', 'entity', array(
            'class'         => 'CarnetAdressesUserBundle:AddressBook',
            'property'      => 'contacts',
            'querybuilder'  => function(AddressBookRepository $r) use ($user) {
                return $r->findAddressBookOf($user);
            },
            'expanded'      => true,
            'multiple'      => true,
        ));
    }
    
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'CarnetAdresses\UserBundle\Entity\AddressBook'
        ));
    }

    
    /**
     * @return string
     */
    public function getName() {
        return 'carnetadresses_userbundle_addressbook';
    }
}
