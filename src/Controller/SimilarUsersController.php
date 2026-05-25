<?php
declare(strict_types=1);


namespace App\Controller;

use App\Repository\UserProfileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SimilarUsersController extends AbstractController
{
    public function __construct(private readonly UserProfileRepository $userProfileRepository)
    {
    }

    #[Route('/users', name: 'user_list')]
    public function index(): Response
    {
        return $this->render('similar_users/index.html.twig', [
            'users' => $this->userProfileRepository->findBy([], ['id' => 'ASC']),
        ]);
    }

    #[Route('/users/{id}', name: 'user_detail', requirements: ['id' => '\\d+'])]
    public function detail(int $id): Response
    {
        $user = $this->userProfileRepository->find($id);
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
            'users' => $this->userProfileRepository->findBy([], ['id' => 'ASC']),
        ]);
    }
}
