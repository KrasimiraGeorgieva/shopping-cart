<?php

namespace ShoppingCartBundle\Form;


use ShoppingCartBundle\Entity\Category;
use ShoppingCartBundle\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ProductType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('price',NumberType::class, ['label' => 'Price €'])
            ->add('image', TextType::class)
            ->add('quantity', NumberType::class)
            ->add('category', EntityType::class,[
                'class' => Category::class,
                'label' => 'Category name',
                'placeholder' => 'Choose a category'
            ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Product::class
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'shoppingcartbundle_product';
    }


}
