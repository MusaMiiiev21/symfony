<?php
declare(strict_types=1);


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
            ['name' => 'Task 1', 'status' => 'Done', 'dueDate' => '2025-01-01', 'description' => 'Description of task 1', 'priority' => 'High'],
            ['name' => 'Task 2', 'status' => 'In progress', 'dueDate' => '2025-01-02', 'description' => 'Description of task 2', 'priority' => 'Medium'],
            ['name' => 'Task 3', 'status' => 'Not started', 'dueDate' => '2025-01-03', 'description' => 'Description of task 3', 'priority' => 'Low'],
            ['name' => 'Task 4', 'status' => 'Done', 'dueDate' => '2025-01-04', 'description' => 'Description of task 4', 'priority' => 'High'],
            ['name' => 'Task 5', 'status' => 'In progress', 'dueDate' => '2025-01-05', 'description' => 'Description of task 5', 'priority' => 'Medium'],
        ];

        return $this->render('task/list.html.twig', [
            'tasks' => $tasks,
        ]);
    }
}
