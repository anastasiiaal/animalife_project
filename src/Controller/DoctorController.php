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

    #[Route('/', name: 'home')]
    public function home(): Response
    {
        return $this->render('home.html.twig');
    }

    #[Route('/doctors', name: 'doctors', methods: ['GET'])]
    public function index(): Response
    {
        // $doctors = $repository->findAll();
        $query = $this->em->createQueryBuilder()
            ->select('doctor', 'user', 'city')
            ->from('App\Entity\Doctor', 'doctor')
            ->leftJoin('doctor.userId', 'user')
            ->leftJoin('doctor.cityId', 'city')
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
        $query = $this->em->createQueryBuilder()
            ->select('doctor', 'user', 'city', 'animal_types', 'services')
            ->from('App\Entity\Doctor', 'doctor')
            ->leftJoin('doctor.userId', 'user')
            ->leftJoin('doctor.cityId', 'city')
            ->leftJoin('doctor.animalTypes', 'animal_types')
            ->leftJoin('doctor.services', 'services')
            ->where('doctor.id = :doctorId')
            ->setParameter('doctorId', $id)
            ->getQuery();

        $doctor = $query->getOneOrNullResult();

        if ($doctor === null) {
            return $this->redirectToRoute('home'); // replace with error route once ready!!
        }
        // dd($doctor);
        return $this->render('doctor/doctor.html.twig', [
            'doctor' => $doctor
        ]);
    }
}
