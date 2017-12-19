<?php

namespace ShoppingCartBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CartItemType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $options['data'];
        $product = $options['data'];
        $builder
            ->add('orderQuantity', NumberType::class)
            ->add('totalPrice', NumberType::class)
            ->add('createdDate', DateTimeType::class, ['label' => 'Date'])
            ->add('status', ChoiceType::class,
                [
                'choices' => [
                    'Out of Stock' => '0',
                    'In Stock' => '1']
                ])
//            ->add('contactName', TextType::class,
//                [
//                'label' =>'Contact name',
//                'data' => $user->getFullName()
//                ])
            ->add('phoneNumber', TextType::class)
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ShoppingCartBundle\Entity\CartItem'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'shoppingcartbundle_cartitem';
    }


}
