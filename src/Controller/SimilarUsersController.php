<?php
declare(strict_types=1);


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class SimilarUsersController extends AbstractController
{
    public function list(): Response
    {
        // Source of users can be replaced later without touching embedding logic.
        $users = [
            ['id' => 101, 'name' => 'Alex Carter', 'tag' => 'frontend'],
            ['id' => 102, 'name' => 'Mia Thompson', 'tag' => 'design'],
            ['id' => 103, 'name' => 'Daniel Lee', 'tag' => 'backend'],
        ];

        return $this->render('similar_users/list.html.twig', [
            'users' => $users,
        ]);
    }
}
