<?php
// src/Controller/ProductController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController
{
    #[Route('/products', name: 'product_list')]
    public function list(): Response
    {
        return new Response('<html><body><h1>Список продуктов</h1><p>Здесь будет список всех продуктов.</p></body></html>');
    }

    #[Route('/products/{id}', name: 'product_detail')]
    public function detail(int $id): Response
    {
        return new Response('<html><body><h1>Детали продукта</h1><p>Детали продукта с ID: '.$id.'</p></body></html>');
    }

    #[Route('/products/new', name: 'product_new')]
    public function new(): Response
    {
        return new Response('<html><body><h1>Добавить новый продукт</h1><p>Форма для добавления нового продукта.</p></body></html>');
    }
}
