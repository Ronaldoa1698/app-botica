<?php

namespace App\Service\Product;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;


class CreateService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createProduct(array $data): Product
    {
        $product = new Product();
        $product->setName($data['name']);
        $product->setCode($data['code']);
        $product->setPrice($data['price']);

        $this->entityManager->persist($product);
        $this->entityManager->flush();

        return $product;
    }
}
