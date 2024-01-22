<?php

namespace App\Form\Type;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\PositiveOrZero;

class CreateProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', options:[
                'label' => 'Product name',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Name is required',
                    ]),
                ],
                'required' => true,
            ])
            ->add('code', options:[
                'label' => 'Product code',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Code is required',
                    ]),
                ],
            ])
            ->add('price', options:[
                'label' => 'Product price',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Price is required',
                    ]),
                    new PositiveOrZero([
                        'message' => 'Price must be positive or zero',
                    ]),
                ],
            ])
            ->add('stock', options:[
                'label' => 'Product stock',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Stock is required',
                    ]),
                    new PositiveOrZero([
                        'message' => 'Stock must be positive or zero',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}