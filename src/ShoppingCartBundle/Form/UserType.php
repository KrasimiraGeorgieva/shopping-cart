<?php

namespace ShoppingCartBundle\Form;

use ShoppingCartBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\User\UserInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$options['data']['username']
        /**
         * @var User $user
         */
        $user = $options['data'];
        //dump($user->getFullName()); dump($user->getEmail());
        $builder
            ->add("email", EmailType::class, array(
                'data'=> $user->getEmail()
            ))
            ->add("fullName", TextType::class, array(
                'data' => $user->getFullName()
            ))
            ->add("password", PasswordType::class)
            ->add("confirm", PasswordType::class)
            ->add('submit',SubmitType::class);
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
        return 'shopping_cart_bundle_user_type';
    }
}
