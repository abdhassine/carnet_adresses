<?php

namespace CarnetAdresses\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\QueryBuilder;


class AddressBookType extends AbstractType {
    private $queryBuilder;
    
    
    public function __construct(QueryBuilder $queryBuilder) {
        $this->queryBuilder = $queryBuilder;
    }
    
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('contacts', 'entity', array(
            'class'         => 'CarnetAdressesUserBundle:User',
            'query_builder' => $this->queryBuilder,
            'expanded'      => true,
            'multiple'      => true,
        ));
    }
    
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'CarnetAdresses\AppBundle\Entity\AddressBook'
        ));
    }

    
    /**
     * @return string
     */
    public function getName() {
        return 'carnetadresses_appbundle_address_book';
    }
}
