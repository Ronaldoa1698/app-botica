<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\CreateProductType;
use App\Service\Product\DeleteService;
use App\Service\Product\UpdateService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ProductController extends AbstractController
{
    #[Route('/product', name: 'create', methods: ['POST'])]
    public function createProduct(Request $request, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);

        $form = $this->createForm(CreateProductType::class, new Product());
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();

            $entityManager->persist($product);
            $entityManager->flush();

            return $this->json([
                'id' => $product->getId(),
                'name' => $product->getName(),
                'code' => $product->getCode(),
                'price' => $product->getPrice(),
            ]);
        }

        return $this->json([
            'message' => 'Product not created',
        ], 400);
    }

    #[Route('/products/{id}', name: 'update', methods: ['PUT'])]
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

    #[Route('/products/{id}', name: 'delete', methods: ['DELETE'])]
    public function deleteProduct(DeleteService $service, Product $product): Response
    {
        $service->deleteProduct($product);

        return $this->json([
            'message' => 'Product deleted',
        ]);
    }
}
