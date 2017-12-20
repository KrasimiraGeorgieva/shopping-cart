<?php

namespace ShoppingCartBundle\Form;

use ShoppingCartBundle\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$options['data']['username']
        $builder
            ->add('fullName', EntityType::class)
            ->add('password', PasswordType::class, ['action' => 'password'])
            ->add('confirm', PasswordType::class, ['action' => 'confirm'])
            ->add('newPassword', PasswordType::class, ['action' => 'newPassword'])
            ->add('wallet', NumberType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(
            [
                'data_class' => User::class
            ]
        );
    }

    public function getBlockPrefix()
    {
        return 'shopping_cart_bundle_user_edit_type';
    }
}
