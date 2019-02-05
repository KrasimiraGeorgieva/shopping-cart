<?php

namespace ShoppingCartBundle\Form;

use ShoppingCartBundle\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CategoryType
 * @package ShoppingCartBundle\Form
 */
class CategoryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $category = $options['data'];
        $builder->add('name', TextType::class,
            [
                'label' => 'Name',
                'data' => $category->getName()
            ]
        );
    }

    /**
     * @param OptionsResolver $resolver
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
     * @return string
     */
    public function getName(): string
    {
        return 'shoppingcartbundle_category';
    }
}