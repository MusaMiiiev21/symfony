<?php
// src/Controller/CartController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CartController
{
    #[Route('/cart', name: 'cart_view')]
    public function view(): Response
    {
        return new Response('<html><body><h1>Корзина</h1><p>Содержимое вашей корзины.</p></body></html>');
    }

    #[Route('/cart/add/{productId}', name: 'cart_add')]
    public function add(int $productId): Response
    {
        return new Response('<html><body><h1>Товар добавлен в корзину</h1><p>Товар с ID: '.$productId.' был добавлен в вашу корзину.</p></body></html>');
    }

    #[Route('/cart/remove/{productId}', name: 'cart_remove')]
    public function remove(int $productId): Response
    {
        return new Response('<html><body><h1>Товар удален из корзины</h1><p>Товар с ID: '.$productId.' был удален из вашей корзины.</p></body></html>');
    }
}
