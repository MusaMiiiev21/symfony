<?php
declare(strict_types=1);


namespace App\Controller;

use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TaskController extends AbstractController
{
    public function __construct(private readonly TaskRepository $taskRepository)
    {
    }

    #[Route('/tasks', name: 'tasks')]
    public function list(): Response
    {
        return $this->render('task/list.html.twig', [
            'tasks' => $this->taskRepository->findBy([], ['id' => 'ASC']),
        ]);
    }

    #[Route('/tasks/{id}', name: 'task_detail', requirements: ['id' => '\\d+'])]
    public function detail(int $id): Response
    {
        $task = $this->taskRepository->find($id);
        if ($task === null) {
            throw $this->createNotFoundException('Task not found.');
        }

        return $this->render('task/detail.html.twig', [
            'task' => $task,
        ]);
    }
}
