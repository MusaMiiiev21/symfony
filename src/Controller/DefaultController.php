<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController
{
    #[Route('/', name: 'default_index')]
    public function index(): Response
    {
        return new Response(
            '<html><body>Hello World!</body></html>'
        );
    }
}
