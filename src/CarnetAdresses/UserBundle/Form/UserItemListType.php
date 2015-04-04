<?php

namespace CarnetAdresses\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\QueryBuilder;


class UserItemListType extends AbstractType {
    private $queryBuilder;
    
    
    public function __construct(QueryBuilder $queryBuilder) {
        $this->queryBuilder = $queryBuilder;
    }
    
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('user', 'entity', array(
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
            'data_class' => 'CarnetAdresses\UserBundle\Entity\User'
        ));
    }

    
    /**
     * @return string
     */
    public function getName() {
        return 'carnetadresses_userbundle_user_item_list';
    }
}
