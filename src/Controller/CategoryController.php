<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    #[Route('/categories', name: 'category_list')]
    public function list(): Response
    {
        return $this->render('category/list.html.twig');
    }

    #[Route('/categories/new', name: 'category_new')]
    public function new(): Response
    {
        return $this->render('category/new.html.twig');
    }

    #[Route('/categories/{id}', name: 'category_detail', requirements: ['id' => '\\d+'])]
    public function detail(int $id): Response
    {
        return $this->render('category/detail.html.twig', ['id' => $id]);
    }
}