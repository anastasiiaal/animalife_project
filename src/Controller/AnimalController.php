<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Entity\PetOwner;
use App\Entity\User;
use App\Form\AnimalFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

class AnimalController extends AbstractController
{
    private $em;
    private $security;

    public function __construct(EntityManagerInterface $em, Security $security)
    {
        $this->em = $em;
        $this->security = $security;
    }

    #[Route('/account/new-animal', name: 'create_animal')]
    public function createAnimal(Request $request): Response
    {

        $animal = new Animal();
        $user = $this->security->getUser();
        
        $petOwner = $this->em->getRepository(PetOwner::class)->findOneBy(['userId' => $user]);
        
        if (!$petOwner) {
            return $this->redirectToRoute('error404');
        }
        
        $animal->setOwnerId($petOwner); 

        if ($animal->getSex() === null) {
            $animal->setSex('male');
        }
        
        $form = $this->createForm(AnimalFormType::class, $animal);
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
                } catch(FileException $e) {
                    return new Response($e->getMessage());
                }

                $animal->setImagePath('/uploads/' . $newFileName);
            }

            $this->em->persist($animal);
            $this->em->flush();

            return $this->redirectToRoute('user_account');
        }

        return $this->render('animal/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/account/edit-animal/{id}', name: 'update_animal')]
    public function updateAnimal($id, Request $request): Response
    {
        $animal = $this->em->getRepository(Animal::class)->find($id);

        if (!$animal) {
            throw $this->createNotFoundException('Animal not found.');
        }

        $user = $this->security->getUser();
        $petOwner = $this->em->getRepository(PetOwner::class)->findOneBy(['userId' => $user]);

        if ($animal->getOwnerId() !== $petOwner) {
            return $this->redirectToRoute('error403');
        }

        $form = $this->createForm(AnimalFormType::class, $animal);
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

                    $animal->setImagePath('/uploads/' . $newFileName);
                } catch (FileException $e) {
                    return new Response($e->getMessage());
                }
            }

            $this->em->flush(); 

            return $this->redirectToRoute('user_account');
        }

        return $this->render('animal/update.html.twig', [
            'form' => $form->createView(),
            'animal' => $animal
        ]);
    }

    #[Route('/account/delete-animal/{id}', methods: ['GET', 'DELETE'], name: 'delete_animal')]
    public function deleteAnimal($id, Request $request): Response
    {
        $animal = $this->em->getRepository(Animal::class)->find($id);

        // Vérifier si l'animal existe
        if (!$animal) {
            $this->addFlash('error', 'Animal introuvable.');
            return $this->redirectToRoute('list_animals');
        }
    
        $user = $this->security->getUser();
        $petOwner = $this->em->getRepository(PetOwner::class)->findOneBy(['userId' => $user]);
    

        if ($animal->getOwnerId() !== $petOwner) {
            $this->addFlash('error', 'Vous n\'avez pas le droit de supprimer cet animal.');
            return $this->redirectToRoute('user_account');
        } else {
            $this->em->remove($animal);
            $this->em->flush();

            return $this->redirectToRoute('user_account');
        }
    }
}
