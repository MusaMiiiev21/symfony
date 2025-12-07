<?php
// src/Controller/CategoryController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController
{
    #[Route('/categories', name: 'category_list')]
    public function list(): Response
    {
        return new Response('<html><body><h1>Список категорий</h1><p>Здесь будет список всех категорий.</p></body></html>');
    }

    #[Route('/categories/{id}', name: 'category_detail')]
    public function detail(int $id): Response
    {
        return new Response('<html><body><h1>Детали категории</h1><p>Детали категории с ID: '.$id.'</p></body></html>');
    }

    #[Route('/categories/new', name: 'category_new')]
    public function new(): Response
    {
        return new Response('<html><body><h1>Добавить новую категорию</h1><p>Форма для добавления новой категории.</p></body></html>');
    }
}
