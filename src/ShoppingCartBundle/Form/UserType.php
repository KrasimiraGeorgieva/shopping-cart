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

/**
 * Class UserType
 * @package ShoppingCartBundle\Form
 */
class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /**
         * @var User $user
         */
        $user = $options['data'];
        $builder
            ->add('email', EmailType::class, [
                'data' => $user->getEmail()
            ])
            ->add('fullName', TextType::class, [
                'data' => $user->getFullName()
            ])
            ->add('password', PasswordType::class)
            ->add('confirm', PasswordType::class)
            ->add('submit', SubmitType::class);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => User::class
            ]);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'shopping_cart_bundle_user_type';
    }
}