<?php

namespace ShoppingCartBundle\Form;

use ShoppingCartBundle\Entity\Cart;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CartType
 * @package ShoppingCartBundle\Form
 */
class CartType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('hash', TextType::class)
            ->add('productName', TextType::class)
            ->add('productQuantity', NumberType::class)
            ->add('createdDate', DateTimeType::class, ['label' => 'Date'])
            ->add('updatedDate', DateTimeType::class, ['label' => 'Date'])
            ->add('total', NumberType::class);

    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Cart::class
            ]
        );
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'shopping_cart_bundle_cart_type';
    }
}