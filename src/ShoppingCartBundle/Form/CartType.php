<?php

namespace ShoppingCartBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CartType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('hash', TextType::class)
            ->add('productName', TextType::class)
            ->add('productQuantity', NumberType::class)
            ->add('createdDate', DateTimeType::class, ['label' => 'Date'])
            ->add('updatedDate', DateTimeType::class, ['label' => 'Date'])
            ->add('total', NumberType::class);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => CartType::class
            ]
        );
    }

    public function getName()
    {
        return 'shopping_cart_bundle_cart_type';
    }
}
