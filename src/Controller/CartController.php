<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CartController extends AbstractController
{
    public function __construct(private readonly RequestStack $requestStack)
    {
    }

    #[Route('/cart', name: 'cart_view')]
    public function view(): Response
    {
        $cart = $this->getCart();

        return $this->render('cart/view.html.twig', [
            'items' => $cart,
            'totalItems' => array_sum($cart),
        ]);
    }

    #[Route('/cart/add/{productId}', name: 'cart_add', requirements: ['productId' => '\\d+'])]
    public function add(int $productId): Response
    {
        $cart = $this->getCart();
        $cart[$productId] = ($cart[$productId] ?? 0) + 1;
        $this->saveCart($cart);

        $this->addFlash('success', sprintf('Product #%d added to cart.', $productId));

        return $this->redirectToRoute('cart_view');
    }

    #[Route('/cart/remove/{productId}', name: 'cart_remove', requirements: ['productId' => '\\d+'])]
    public function remove(int $productId): Response
    {
        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            $cart[$productId]--;

            if ($cart[$productId] <= 0) {
                unset($cart[$productId]);
            }

            $this->saveCart($cart);
            $this->addFlash('warning', sprintf('Product #%d removed from cart.', $productId));
        } else {
            $this->addFlash('warning', sprintf('Product #%d is not in cart.', $productId));
        }

        return $this->redirectToRoute('cart_view');
    }

    private function getCart(): array
    {
        return $this->requestStack->getSession()->get('cart', []);
    }

    private function saveCart(array $cart): void
    {
        $session = $this->requestStack->getSession();
        $session->set('cart', $cart);
        $session->set('cart_count', array_sum($cart));
    }
}
