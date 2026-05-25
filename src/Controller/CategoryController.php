<?php
declare(strict_types=1);


namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    public function __construct(private readonly CategoryRepository $categoryRepository)
    {
    }

    #[Route('/categories', name: 'category_list')]
    public function list(): Response
    {
        return $this->render('category/list.html.twig', [
            'categories' => $this->categoryRepository->findBy([], ['id' => 'ASC']),
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
        $category = $this->categoryRepository->find($id);
        if ($category === null) {
            throw $this->createNotFoundException('Category not found.');
        }

        return $this->render('category/detail.html.twig', [
            'category' => $category,
        ]);
    }
}
