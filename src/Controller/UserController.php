<?php

namespace App\Controller;

use App\Entity\PetOwner;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    private $em;
    private $security;

    public function __construct(EntityManagerInterface $em, Security $security)
    {
        $this->em = $em;
        $this->security = $security;
    }

    #[Route('/account', name: 'user_account')]
    public function index(): Response
    {
        $user = $this->security->getUser();
        // dd($user);

        if (!$user) {
            return $this->redirectToRoute('app_login'); // Redirect to login
        }

        // Check the user's role ID
        if ($user->getRoleId() == 1) {
            // Handle regular users
            $petOwner = $this->em->getRepository(PetOwner::class)->findOneBy(['userId' => $user]);

            if (!$petOwner) {
                // Handle cases where there is no PetOwner record for the user
                return $this->render('user/index.html.twig', [
                    'user' => $user,
                    'animals' => []
                ]);
            }

            $animals = $petOwner->getAnimals();
            $animalDetails = [];

            // Populate animal details including type name
            foreach ($animals as $animal) {
                $animalDetails[] = [
                    'id' => $animal->getId(),
                    'name' => $animal->getName(),
                    'imagePath' => $animal->getImagePath(),
                    'dateBirth' => $animal->getDateBirth() ? $animal->getDateBirth()->format('Y-m-d') : null,
                    'sex' => $animal->getSex(),
                    'isSterilized' => $animal->isIsSterilized(),
                    'allergy' => $animal->getAllergy(),
                    'additionalInfo' => $animal->getAdditionalInfo(),
                    'typeName' => $animal->getTypeId() ? $animal->getTypeId()->getTypeName() : 'Unknown',
                ];
            }

            // dd($animalDetails);
            return $this->render('user/index.html.twig', [
                'user' => $user,
                'animals' => $animalDetails
            ]);
        } else if ($user->getRoleId() == 2) {
            // Handle users with roleId == 2, e.g., doctors
            return $this->render('user/doctor.html.twig', [
                'user' => $user
            ]);
        }

        // Optionally handle other roles or invalid roleIds
        return $this->redirectToRoute('home');
    }

    
}
