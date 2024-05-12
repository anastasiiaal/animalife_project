<?php

namespace App\Controller;

use App\Entity\Doctor;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DoctorController extends AbstractController
{
    private $em;
    private $security;

    public function __construct(EntityManagerInterface $em, Security $security)
    {
        $this->em = $em;
        $this->security = $security;
    }

    #[Route('/doctors', name: 'doctors', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $queryBuilder = $this->em->createQueryBuilder()
            ->select('doctor', 'user', 'city', 'animal_types')
            ->from('App\Entity\Doctor', 'doctor')
            ->leftJoin('doctor.userId', 'user')
            ->leftJoin('doctor.cityId', 'city')
            ->leftJoin('doctor.animalTypes', 'animal_types');

        $name = $request->query->get('name');
        if ($name) {
            $queryBuilder->andWhere('user.firstName LIKE :name OR user.lastName LIKE :name OR doctor.clinicName LIKE :name')
                        ->setParameter('name', '%' . $name . '%');
        }

        $animal = $request->query->get('animal');
        if ($animal) {
            $queryBuilder->andWhere('animal_types.typeName LIKE :animal')
                        ->setParameter('animal', '%' . $animal . '%');
        }

        $location = $request->query->get('location');
        if ($location) {
            $queryBuilder->andWhere('city.cityName LIKE :location OR city.postcode LIKE :location')
                        ->setParameter('location', '%' . $location . '%');
        }

        $doctors = $queryBuilder->getQuery()->getResult();

        return $this->render('doctor/list.html.twig', [
            'doctors' => $doctors,
            'emergency' => false
        ]);
    }

    #[Route('/doctors/{slug}', name: 'doctor', defaults: ['slug' => null], methods: ['GET', 'HEAD'])]
    public function doctor($slug): Response
    {
        $query = $this->em->createQueryBuilder()
            ->select('doctor', 'user', 'city', 'animal_types', 'services')
            ->from('App\Entity\Doctor', 'doctor')
            ->leftJoin('doctor.userId', 'user')
            ->leftJoin('doctor.cityId', 'city')
            ->leftJoin('doctor.animalTypes', 'animal_types')
            ->leftJoin('doctor.services', 'services')
            ->where('doctor.nameSlug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery();

        $doctor = $query->getOneOrNullResult();

        if ($doctor === null) {
            // return $this->redirectToRoute('home'); // replace with error route once ready!!
            return $this->render('error/404.html.twig');
        }
        // dd($doctor);
        return $this->render('doctor/doctor.html.twig', [
            'doctor' => $doctor
        ]);
    }

    #[Route('/urgency', name: 'urgency', methods: ['GET'])]
    public function urgency(Request $request): Response
    {
        $queryBuilder = $this->em->createQueryBuilder()
            ->select('doctor', 'user', 'city', 'animal_types')
            ->from('App\Entity\Doctor', 'doctor')
            ->leftJoin('doctor.userId', 'user')
            ->leftJoin('doctor.cityId', 'city')
            ->leftJoin('doctor.animalTypes', 'animal_types')
            ->where('doctor.isEmergency = :emergency')
            ->setParameter('emergency', true);

        $name = $request->query->get('name');
        if ($name) {
            $queryBuilder->andWhere('user.firstName LIKE :name OR user.lastName LIKE :name OR doctor.clinicName LIKE :name')
                        ->setParameter('name', '%' . $name . '%');
        }

        $animal = $request->query->get('animal');
        if ($animal) {
            $queryBuilder->andWhere('animal_types.typeName LIKE :animal')
                        ->setParameter('animal', '%' . $animal . '%');
        }

        $location = $request->query->get('location');
        if ($location) {
            $queryBuilder->andWhere('city.cityName LIKE :location OR city.postcode LIKE :location')
                        ->setParameter('location', '%' . $location . '%');
        }

        $queryBuilder->andWhere('doctor.isEmergency = :emergency')
                        ->setParameter('emergency', true);


        $doctors = $queryBuilder->getQuery()->getResult();

        return $this->render('doctor/list.html.twig', [
            'doctors' => $doctors,
            'emergency' => true
        ]);
    }
}
