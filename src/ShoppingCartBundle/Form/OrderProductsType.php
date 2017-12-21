<?php

namespace ShoppingCartBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderProductsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //dump($options);
        $builder;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => OrderProductsType::class
            ]
        );
    }

    public function getName()
    {
        return 'shopping_cart_bundle_order_products';
    }
}
