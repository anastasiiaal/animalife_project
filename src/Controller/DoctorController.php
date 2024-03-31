<?php

namespace App\Controller;

use App\Entity\Doctor;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DoctorController extends AbstractController
{
    #[Route('/doctors', name: 'doctors', methods: ['GET'])]
    public function index(EntityManagerInterface $em): Response
    {
        $repository = $em->getRepository(Doctor::class);
        $doctors = $repository->findAll();
        dd($doctors);
        return $this->render('doctor/index.html.twig', [
            'doctors' => $doctors,
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
