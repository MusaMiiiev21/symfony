<?php
declare(strict_types=1);


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    #[Route('/categories', name: 'category_list')]
    public function list(): Response
    {
        return $this->render('category/list.html.twig', [
            'categories' => $this->getDemoCategories(),
        ]);
    }

    #[Route('/categories/new', name: 'category_new')]
    public function new(): Response
    {
        return $this->render('category/new.html.twig');
    }

    #[Route('/categories/{id}', name: 'category_detail', requirements: ['id' => '\\d+'])]
    public function detail(int $id): Response
    {
        $category = null;
        foreach ($this->getDemoCategories() as $item) {
            if ($item['id'] === $id) {
                $category = $item;
                break;
            }
        }

        if ($category === null) {
            throw $this->createNotFoundException('Category not found.');
        }

        return $this->render('category/detail.html.twig', [
            'category' => $category,
        ]);
    }

    private function getDemoCategories(): array
    {
        return [
            ['id' => 1, 'name' => 'Electronics', 'description' => 'Gadgets and devices'],
            ['id' => 2, 'name' => 'Books', 'description' => 'Printed and digital books'],
            ['id' => 3, 'name' => 'Home', 'description' => 'Home and kitchen items'],
        ];
    }
}
