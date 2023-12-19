<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\Product\CreateService;
use App\Service\Product\UpdateService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class ProductController extends AbstractController
{
    #[Route('/product', name: 'create', methods: ['POST'])]
    public function createProduct(Request $request, CreateService $createService): Response
    {
        $data = json_decode($request->getContent(), true);
        $product = $createService->createProduct($data);

        return $this->json([
            'id' => $product->getId(),
            'name' => $product->getName(),
            'code' => $product->getCode(),
            'price' => $product->getPrice(),
        ]);
    }

    #[Route('/products/{id}', name: 'get', methods: ['PUT'])]
    public function updateProduct(Request $request, UpdateService $service, Product $product): Response
    {
        $data = json_decode($request->getContent(), true);
        $product = $service->updateProduct($product, $data);

        return $this->json([
            'id' => $product->getId(),
            'name' => $product->getName(),
            'code' => $product->getCode(),
            'price' => $product->getPrice(),
        ]);
    }
}
