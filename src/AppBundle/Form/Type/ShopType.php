<?php

// src/AppBundle/Form/Type/TaskType.php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use AppBundle\Entity\Shop;
use AppBundle\Form\Type\ShopInfoType;

class ShopType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name', 'text', array("attr" => array("required" => true)))
        ->add('address', 'text', array("attr" => array("required" => true)))
        ->add('save', 'submit', array("attr" => array("required" => true)))
        ;
    }

    public function getName()
    {
        return 'shop';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
{
    $resolver->setDefaults(array(
        'data_class' => 'AppBundle\Entity\Shop',
    ));
}

}
