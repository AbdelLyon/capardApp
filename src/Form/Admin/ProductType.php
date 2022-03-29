<?php

declare(strict_types=1);

namespace App\Form\Admin;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Subcategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'label' => 'Titre'
            ])
            ->add('brand', null, [
                'label' => 'Marque'
            ])
            ->add('imageFile', VichImageType::class, [
                'allow_delete' => false,
                'delete_label' => null,

            ])
            ->add('description', null, [
                'label' => 'Déscription',
                "constraints" => [
                    new Length(min: 2)
                ]
            ])
            ->add('price', null, [
                'label' => 'Prix'
            ])

            ->add('category', EntityType::class, [
                'class' => Category::class
            ])

            ->add('subcategory', EntityType::class, [
                'class' => Subcategory::class
            ])
            ->add('quantity', null, [
                'label' => 'Quantité',
            ])
            ->add('isActive', null, [
                'label' => 'Acif',

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
