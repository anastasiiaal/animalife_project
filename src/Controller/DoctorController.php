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
        // $doctors = $repository->findAll();
        $query = $this->em->createQueryBuilder()
        ->select('doctor', 'user')
        ->from('App\Entity\Doctor', 'doctor')
        ->leftJoin('doctor.userId', 'user')
        ->getQuery();
        
        $doctors = $query->getResult();
        // dd($doctors);
        
        return $this->render('doctor/index.html.twig', [
            'doctors' => $doctors,
        ]);
    }

    #[Route('/doctors/{id}', name: 'doctor', defaults: ['id' => null], methods: ['GET', 'HEAD'])]
    public function doctor($id): Response
    {
        $repository = $this->em->getRepository(Doctor::class);
        $doctor = $repository->find($id)->getUserId();
        $userRepository = $this->em->getRepository(User::class);
        $user = $userRepository->find($doctor);
        $doctor2 = $repository->find($id);
        // dd($doctor2);
        // dd($doctor);
        // dd($user->getFirstName());

        return $this->render('doctor/doctor.html.twig', [
            'doctor' => $doctor2
        ]);
    }
}
