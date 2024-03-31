<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DoctorController extends AbstractController
{
    #[Route('/doctors', name: 'doctors', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('doctor/index.html.twig', [
            'controller_name' => 'DoctorController',
        ]);
    }

    #[Route('/doctors/{id}', name: 'doctor', defaults: ['id' => null], methods: ['GET', 'HEAD'])]
    public function doctor($id): Response
    {
        return $this->render('doctor/doctor.html.twig', [
            'controller_name' => 'SingleDoctorController',
            'id' => $id
        ]);
    }
}
