<?php

namespace ShoppingCartBundle\Form;

use ShoppingCartBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserBanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('ban', ChoiceType::class, array(
            'choices' => array(
                 1, 0
            )));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => User::class
            ]
        );
    }

    public function getName()
    {
        return 'shopping_cart_bundle_user_ban_type';
    }
}
