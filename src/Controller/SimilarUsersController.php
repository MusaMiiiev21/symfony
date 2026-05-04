<?php
declare(strict_types=1);


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SimilarUsersController extends AbstractController
{
    #[Route('/users', name: 'user_list')]
    public function index(): Response
    {
        return $this->render('similar_users/index.html.twig', [
            'users' => $this->getDemoUsers(),
        ]);
    }

    #[Route('/users/{id}', name: 'user_detail', requirements: ['id' => '\\d+'])]
    public function detail(int $id): Response
    {
        $user = null;
        foreach ($this->getDemoUsers() as $item) {
            if ($item['id'] === $id) {
                $user = $item;
                break;
            }
        }

        if ($user === null) {
            throw $this->createNotFoundException('User not found.');
        }

        return $this->render('similar_users/detail.html.twig', [
            'user' => $user,
        ]);
    }

    public function list(): Response
    {
        return $this->render('similar_users/list.html.twig', [
            'users' => $this->getDemoUsers(),
        ]);
    }

    private function getDemoUsers(): array
    {
        return [
            ['id' => 101, 'name' => 'Alex Carter', 'tag' => 'frontend'],
            ['id' => 102, 'name' => 'Mia Thompson', 'tag' => 'design'],
            ['id' => 103, 'name' => 'Daniel Lee', 'tag' => 'backend'],
        ];
    }
}
