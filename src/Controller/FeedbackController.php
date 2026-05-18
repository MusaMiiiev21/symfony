<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\FeedbackRequest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FeedbackController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    #[Route('/feedback', name: 'feedback_form', methods: ['GET', 'POST'])]
    public function index(Request $request): Response
    {
        $departments = [
            'sales' => 'Sales department',
            'tech' => 'Technical support',
            'support' => 'Customer support',
        ];

        $formData = [
            'name' => '',
            'phone' => '',
            'email' => '',
            'gender' => '',
            'department' => '',
            'message' => '',
        ];
        $errors = [];

        if ($request->isMethod('POST')) {
            $formData = [
                'name' => trim((string) $request->request->get('name', '')),
                'phone' => trim((string) $request->request->get('phone', '')),
                'email' => trim((string) $request->request->get('email', '')),
                'gender' => trim((string) $request->request->get('gender', '')),
                'department' => trim((string) $request->request->get('department', '')),
                'message' => trim((string) $request->request->get('message', '')),
            ];

            if ($formData['name'] === '') {
                $errors['name'] = 'Please enter your name.';
            }
            if ($formData['phone'] === '') {
                $errors['phone'] = 'Please enter your phone.';
            }
            if ($formData['email'] === '' || !filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Please enter a valid email.';
            }
            if (!in_array($formData['gender'], ['male', 'female'], true)) {
                $errors['gender'] = 'Please select gender.';
            }
            if (!array_key_exists($formData['department'], $departments)) {
                $errors['department'] = 'Please select department.';
            }
            if ($formData['message'] === '') {
                $errors['message'] = 'Please enter your message.';
            }

            if ($errors === []) {
                $feedbackRequest = (new FeedbackRequest())
                    ->setName($formData['name'])
                    ->setPhone($formData['phone'])
                    ->setEmail($formData['email'])
                    ->setGender($formData['gender'])
                    ->setDepartment($formData['department'])
                    ->setMessage($formData['message']);

                $this->entityManager->persist($feedbackRequest);
                $this->entityManager->flush();

                $this->addFlash('success', 'Feedback has been sent successfully.');

                return $this->redirectToRoute('feedback_form');
            }
        }

        return $this->render('feedback/index.html.twig', [
            'formData' => $formData,
            'errors' => $errors,
            'departments' => $departments,
        ]);
    }
}