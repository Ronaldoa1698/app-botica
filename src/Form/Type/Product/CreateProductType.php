<?php

namespace App\Form\Type\Product;

use App\Entity\Product;
use http\Message;
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
                    new NotBlank(),
                ],
                'required' => true,
            ])
            ->add('code', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
                'required' => true,
           ])
            ->add('price', NumberType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Type(['type' => 'numeric']),
                ],
                'required' => true,
            ]);
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}