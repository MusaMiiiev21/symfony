<?php

// src/Controller/TaskController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TaskController extends AbstractController
{
    #[Route('/tasks', name: 'tasks')]
    public function list(): Response
    {

        $tasks = [
            ['name' => 'Задача 1', 'status' => 'Выполнена', 'dueDate' => '2025-01-01', 'description' => 'Описание задачи 1', 'priority' => 'Высокий'],
            ['name' => 'Задача 2', 'status' => 'В процессе', 'dueDate' => '2025-01-02', 'description' => 'Описание задачи 2', 'priority' => 'Средний'],
            ['name' => 'Задача 3', 'status' => 'Не начата', 'dueDate' => '2025-01-03', 'description' => 'Описание задачи 3', 'priority' => 'Низкий'],
            ['name' => 'Задача 4', 'status' => 'Выполнена', 'dueDate' => '2025-01-04', 'description' => 'Описание задачи 4', 'priority' => 'Высокий'],
            ['name' => 'Задача 5', 'status' => 'В процессе', 'dueDate' => '2025-01-05', 'description' => 'Описание задачи 5', 'priority' => 'Средний'],
        ];

        return $this->render('task/list.html.twig', [
            'tasks' => $tasks
        ]);
    }
}
