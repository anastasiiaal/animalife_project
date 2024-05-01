<?php

namespace App\Controller;

use App\Entity\Doctor;
use App\Entity\PetOwner;
use App\Entity\User;
use App\Form\DoctorFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
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
            return $this->render('user/owner/user.html.twig', [
                'user' => $user,
                'animals' => $animalDetails
            ]);
        } else if ($user->getRoleId() == 2) {
            // Handle users with roleId == 2, e.g., doctors
            $doctor = $this->em->getRepository(Doctor::class)->findOneBy(['userId' => $user]);
            return $this->render('user/doctor/doctor.html.twig', [
                'doctor' => $doctor
            ]);
        }

        // Optionally handle other roles or invalid roleIds
        return $this->redirectToRoute('home');
    }

    #[Route('/account/edit', name: 'user_edit')]
    public function editAccount(Request $request, Security $security): Response
    {
        // Assuming you have a method to get the current user
        $user = $security->getUser();
        // dd($user);

        if (!$user) {
            return $this->redirectToRoute('app_login'); // Redirect to login
        }

        // Check if the logged-in user is a doctor
        if ($user && $user->getRoleId() == 2) {
            $doctor = $this->em->getRepository(Doctor::class)->findOneBy(['userId' => $user]);

            if (!$doctor) {
                throw $this->createNotFoundException('Doctor profile not found.');
            }
            
            // Create and process the form
            $form = $this->createForm(DoctorFormType::class, $doctor);
            $form->handleRequest($request);
            
            if ($form->isSubmitted() && $form->isValid()) {
                $imagePath = $form->get('imagePath')->getData();
                if ($imagePath) {
                    $newFileName = uniqid() . '.' . $imagePath->guessExtension();
                    try {
                        $imagePath->move(
                            $this->getParameter('kernel.project_dir') . '/public/uploads',
                            $newFileName
                        );
    
                        $doctor->setImagePath('/uploads/' . $newFileName);
                    } catch (FileException $e) {
                        return new Response($e->getMessage());
                    }
                }
    
                $this->em->flush();
                // $this->addFlash('success', 'Doctor's profle updated successfully!');
                return $this->redirectToRoute('user_account');
            }
            

            return $this->render('user/doctor/edit.html.twig', [
                'form' => $form->createView(),
                'doctor' => $doctor
            ]);
        } else {
            throw $this->createAccessDeniedException('You do not have permission to view this page.');
        }
    }
}
