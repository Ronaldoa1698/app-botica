<?php

namespace App\Service\Product;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\Type\Product\CreateProductType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class CreateService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createProduct(Request $request): Product
    {
        $data = json_decode($request->getContent(), true);

        $form = $this->createForm(CreateProductType::class, new Product());
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();

            $this->entityManager->persist($product);
            $this->entityManager->flush();

            return $product;
        }

        return $this->json([
            'message' => 'Product not created',
        ], 400);
    }

}
