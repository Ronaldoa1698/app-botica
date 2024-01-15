<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\Type\CreateProductType;
use App\Service\Product\DeleteService;
use App\Service\Product\UpdateService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


#[Route('/products', name: 'product_')]
class ProductController extends AbstractController
{
    #[Route('/create', name: 'create', methods: ['POST'])]
    public function createProduct(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $product = new Product();
        $form = $this->createForm(CreateProductType::class, $product);
        $form->submit($data);

        if ($form->isValid() && $form->isSubmitted()) {
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
            'errors' => $form->getErrors(true, true),
        ], Response::HTTP_BAD_REQUEST);
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
