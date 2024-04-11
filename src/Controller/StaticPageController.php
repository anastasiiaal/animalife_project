<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StaticPageController extends AbstractController
{
    
    #[Route('/', name: 'home')]
    public function home(): Response
    {
        return $this->render('home.html.twig');
    }
    
    #[Route('/mentions-legales', name: 'mentions-legales')]
    public function legalMentions(): Response
    {
        return $this->render('static_pages/legal_mentions.html.twig');
    }

    #[Route('/politique-de-confidentialite', name: 'politique-de-confidentialite')]
    public function privacyPolicy(): Response
    {
        return $this->render('static_pages/privacy_policy.html.twig');
    }
}
