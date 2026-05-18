<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FeedbackController extends AbstractController
{
    #[Route('/feedback', name: 'feedback_form', methods: ['GET', 'POST'])]
    public function index(Request $request): Response
    {
        $departments = [
            'sales' => 'Отдел продаж',
            'tech' => 'Тех.поддержка',
            'support' => 'Служба поддержки',
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
                $errors['name'] = 'Укажите имя пользователя.';
            }
            if ($formData['phone'] === '') {
                $errors['phone'] = 'Укажите телефон.';
            }
            if ($formData['email'] === '' || !filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Укажите корректную почту.';
            }
            if (!in_array($formData['gender'], ['male', 'female'], true)) {
                $errors['gender'] = 'Выберите пол.';
            }
            if (!array_key_exists($formData['department'], $departments)) {
                $errors['department'] = 'Выберите тему сообщения.';
            }
            if ($formData['message'] === '') {
                $errors['message'] = 'Введите текст сообщения.';
            }

            if ($errors === []) {
                $this->addFlash('success', 'Сообщение отправлено. Спасибо за обратную связь!');

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
