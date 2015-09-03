<?php

namespace CarnetAdressesAppartoo\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\QueryBuilder;


class AddressBookType extends AbstractType {
    private $queryBuilder;
    
    public function __construct(QueryBuilder $queryBuilder) {
        $this->queryBuilder = $queryBuilder;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('contacts', 'entity', array(
            'class'         => 'CarnetAdressesAppartooUserBundle:User',
            'query_builder' => $this->queryBuilder,
            'expanded'      => true,
            'multiple'      => true,
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'CarnetAdressesAppartoo\AppBundle\Entity\AddressBook'
        ));
    }

    public function getName() {
        return 'carnetadresses_appbundle_address_book';
    }
	
}