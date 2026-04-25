<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'cart_view')]
    public function view(): Response
    {
        return $this->render('cart/view.html.twig');
    }

    #[Route('/cart/add/{productId}', name: 'cart_add', requirements: ['productId' => '\\d+'])]
    public function add(int $productId): Response
    {
        $this->addFlash('success', sprintf('Товар #%d добавлен в корзину.', $productId));

        return $this->redirectToRoute('cart_view');
    }

    #[Route('/cart/remove/{productId}', name: 'cart_remove', requirements: ['productId' => '\\d+'])]
    public function remove(int $productId): Response
    {
        $this->addFlash('warning', sprintf('Товар #%d удален из корзины.', $productId));

        return $this->redirectToRoute('cart_view');
    }
}
