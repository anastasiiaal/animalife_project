<?php

namespace App\Controller;

use App\Entity\Doctor;
use App\Entity\PetOwner;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\LoginFormAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\Security\Http\Authenticator\AuthenticatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, Security $security, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        // by default, we set role id to 1 == normal user / pet owner 
        $user->setRoleId(1);
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();

            $petOwner = new PetOwner();
            $petOwner->setUserId($user); // Linking the User to the PetOwner
            $entityManager->persist($petOwner);
            $entityManager->flush(); // Final flush to save everything

            // do anything else you need here, like send an email

            return $security->login($user, LoginFormAuthenticator::class, 'main');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }

    #[Route('/doctor/register', name: 'vet_register')]
    public function vetRegister(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, Security $security): Response
    {
        $user = new User();
        $user->setRoleId(2);

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();

            $nameSlug = strtolower($user->getFirstName()) . '-' . strtolower($user->getLastName()) . '-' . ($user->getId() * 7 + 121);

            $doctor = new Doctor();
            $doctor->setUserId($user);
            $doctor->setNameSlug($nameSlug);
            $doctor->setIsEmergency(false);
            $entityManager->persist($doctor);
            $entityManager->flush();

            // return $this->redirectToRoute('app_login'); // should add redirect to doctor info setup
            $security->login($user, LoginFormAuthenticator::class, 'main');
            return $this->redirectToRoute('user_edit');
    
            // return $this->redirectToRoute('user_account');
            // return $this->redirectToRoute('vet_info');
        }

        return $this->render('registration/vet_register.html.twig', [
            'registrationForm' => $form,
        ]);
    }
}
