<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ErrorController extends AbstractController
{
    #[Route('/error/404', name: 'error404')]
    public function show404(): Response
    {
        return $this->render('error/404.html.twig');
    }

    #[Route('/error/403', name: 'error403')]
    public function show403(): Response
    {
        return $this->render('error/403.html.twig');
    }
}
