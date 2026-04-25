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
        return $this->render('product/list.html.twig');
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

        $similarProducts = $this->getSimilarProducts($id);

        return $this->render('product/detail.html.twig', [
            'product' => $product,
            'similarProducts' => $similarProducts,
        ]);
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