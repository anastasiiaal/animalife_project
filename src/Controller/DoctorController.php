<?php

namespace App\Controller;

use App\Entity\Doctor;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DoctorController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/doctors', name: 'doctors', methods: ['GET'])]
    public function index(): Response
    {
        $repository = $this->em->getRepository(Doctor::class);
        $doctors = $repository->find(4)->getUserId();
        $userRepository = $this->em->getRepository(User::class);
        $user = $userRepository->find($doctors);
        dd($user->getFirstName());
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
