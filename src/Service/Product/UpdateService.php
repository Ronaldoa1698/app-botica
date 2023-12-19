<?php

namespace App\Service\Product;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class UpdateService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function updateProduct(Product $product, array $data): Product
    {
        $product->setName($data['name']);
        $product->setCode($data['code']);
        $product->setPrice($data['price']);

        $this->entityManager->flush();

        return $product;
    }
}
