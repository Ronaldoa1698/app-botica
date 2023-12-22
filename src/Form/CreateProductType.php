<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;


class CreateProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Name is required',
                    ]),
                ],
            ])
            ->add('code', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Code is required',
                    ]),
                ],
            ])
            ->add('price', NumberType::class, [
                'constraints' => [
                    new Type([
                        'type' => 'float',
                        'message' => 'Price must be a float',
                    ]),
                ],
            ]);
    }

    //public function configureOptions(OptionsResolver $resolver): void
    //{
    //    $resolver->setDefaults([
    //        'data_class' => Product::class,
    //    ]);
    //}
}