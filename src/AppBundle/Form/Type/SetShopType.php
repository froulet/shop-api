<?php

// src/AppBundle/Form/Type/TaskType.php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use AppBundle\Entity\Shop;

class SetShopType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('id', 'text', array("mapped" => false))
        ->add('name', 'text')
        ->add('address', 'text')
        ->add('save', 'submit')
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
