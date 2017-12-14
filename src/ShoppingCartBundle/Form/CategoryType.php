<?php

namespace ShoppingCartBundle\Form;

use ShoppingCartBundle\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $category = $options['data'];
        $builder->add('name',TextType::class,
            [
                'label' =>'Name',
                'data' => $category->getName()
            ]
        );
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
            'data_class' => Category::class
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'shoppingcartbundle_category';
    }


}
