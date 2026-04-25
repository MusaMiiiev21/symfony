<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route('/products', name: 'product_list')]
    public function list(): Response
    {
        return $this->render('product/list.html.twig', [
            'products' => $this->getDemoProducts(),
        ]);
    }

    #[Route('/products/{id}', name: 'product_detail', requirements: ['id' => '\\d+'])]
    public function detail(int $id): Response
    {
        if ($id < 1) {
            throw $this->createNotFoundException('Invalid product id.');
        }

        $product = [
            'id' => $id,
            'name' => 'Product ' . $id,
            'description' => 'Description for product ' . $id,
        ];

        return $this->render('product/detail.html.twig', [
            'product' => $product,
            'similarProducts' => $this->getSimilarProducts($id),
        ]);
    }

    private function getDemoProducts(): array
    {
        return [
            ['id' => 1, 'name' => 'Product 1', 'description' => 'Description for product 1'],
            ['id' => 2, 'name' => 'Product 2', 'description' => 'Description for product 2'],
            ['id' => 3, 'name' => 'Product 3', 'description' => 'Description for product 3'],
            ['id' => 4, 'name' => 'Product 4', 'description' => 'Description for product 4'],
            ['id' => 5, 'name' => 'Product 5', 'description' => 'Description for product 5'],
        ];
    }

    private function getSimilarProducts(int $id): array
    {
        return [
            [
                'id' => max(1, $id - 1),
                'name' => 'Similar product ' . max(1, $id - 1),
                'description' => 'Alternative option close to product ' . $id,
            ],
            [
                'id' => $id + 1,
                'name' => 'Similar product ' . ($id + 1),
                'description' => 'Alternative option close to product ' . $id,
            ],
            [
                'id' => $id + 2,
                'name' => 'Similar product ' . ($id + 2),
                'description' => 'Alternative option close to product ' . $id,
            ],
        ];
    }
}
