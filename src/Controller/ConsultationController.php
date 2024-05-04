<?php

namespace App\Controller;

use App\Entity\Doctor;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ConsultationController extends AbstractController
{
    private $em;
    private $security;

    public function __construct(EntityManagerInterface $em, Security $security)
    {
        $this->em = $em;
        $this->security = $security;
    }

    #[Route('/consultation', name: 'app_consultation')]
    public function index(): Response
    {
        return $this->render('consultation/index.html.twig', [
            'controller_name' => 'ConsultationController',
        ]);
    }

    #[Route('/account/consultation/{id}', name: 'consultation')]
    public function consultation ($id): Response
    {
        $user = $this->security->getUser();
        // dd($user);

        if (!$user) {
            return $this->redirectToRoute('app_login'); // Redirect to login
        }

        // Check the user's role ID
        if ($user->getRoleId() == 1) {
            // for now normal users are just redirected to their account
            return $this->redirectToRoute('user_account');
        } else if ($user->getRoleId() == 2) {
            // Handle users with roleId == 2, e.g., doctors
            $doctor = $this->em->getRepository(Doctor::class)->findOneBy(['userId' => $user]);
            if (!$doctor) {
                return $this->redirectToRoute('login');
            }

            $consultation = $this->em->createQueryBuilder()
                ->select('c', 'a', 'v', 't', 'p')
                ->from('App\Entity\Consultation', 'c')
                ->leftJoin('c.animalId', 'a')
                ->leftJoin('a.typeId', 't')
                ->leftJoin('a.ownerId', 'p') 
                ->leftJoin('c.vaccinations', 'v')
                ->where('c.id = :id')
                ->andWhere('c.doctorId = :doctor')
                ->setParameter('id', $id)
                ->setParameter('doctor', $doctor)
                ->getQuery()
                ->getOneOrNullResult();

            if (!$consultation) {
                return $this->redirectToRoute('user_account'); 
            }

            return $this->render('user/doctor/consultation.html.twig', [
                'doctor' => $doctor,
                'consultation' => $consultation
            ]);
        }

        // Optionally handle other roles or invalid roleIds
        return $this->redirectToRoute('home');
    }
}
