<?php

namespace ShoppingCartBundle\Form;

use ShoppingCartBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class UserBanType
 * @package ShoppingCartBundle\Form
 */
class UserBanType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('ban', ChoiceType::class, [
            'choices' => [
                1, 0
            ]]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => User::class
            ]
        );
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'shopping_cart_bundle_user_ban_type';
    }
}