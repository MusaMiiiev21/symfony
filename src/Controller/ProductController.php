<?php
// src/Controller/ProductController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/products', name: 'product_list')]
    public function list(): Response
    {
        return $this->render('product/list.html.twig');
    }

    #[Route('/products/{id}', name: 'product_detail')]
    public function detail(int $id): Response
    {

        $product = [
            'id' => $id,
            'name' => 'Продукт ' . $id,
            'description' => 'Описание продукта ' . $id,
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
                'id' => 1,
                'name' => 'Похожий продукт 1',
                'description' => 'Описание похожего продукта 1',
            ],
            [
                'id' => 2,
                'name' => 'Похожий продукт 2',
                'description' => 'Описание похожего продукта 2',
            ],
            [
                'id' => 3,
                'name' => 'Похожий продукт 3',
                'description' => 'Описание похожего продукта 3',
            ],
        ];
    }
}

