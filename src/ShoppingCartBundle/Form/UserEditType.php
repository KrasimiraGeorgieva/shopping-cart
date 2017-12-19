<?php

namespace ShoppingCartBundle\Form;

use ShoppingCartBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$options['data']['username']
        $builder
            ->add("password", PasswordType::class, ['action' => 'password'])
            ->add("confirm", PasswordType::class, ['action' => 'confirm'])
            ->add("newPassword", PasswordType::class, ['action' => 'newPassword']);
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
