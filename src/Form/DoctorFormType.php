<?php

namespace App\Form;

use App\Entity\AnimalType;
use App\Entity\City;
use App\Entity\Doctor;
use App\Entity\Service;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DoctorFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imagePath', FileType::class, [
                'label' => 'Photo de profil',
                'mapped' => false,
                'required' => false,
                'attr' => array(
                    'class' => ''
                ),
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse de votre cabnet ou Clinique',
                'required' => true,
                'attr' => array(
                    'placeholder' => '74 avenue des Platanes'
                ),
            ])
            ->add('clinicName', TextType::class, [
                'label' => 'Nom de votre clinique',
                'required' => false,
                'attr' => array(
                    'placeholder' => 'Clinique vétérinaire Vétolib'
                ),
            ])
            ->add('education', TextareaType::class, [
                'label' => 'Vos diplomes, certificats, etc.',
                'required' => false,
                'attr' => array(
                    'placeholder' => '2015 : Diplôme d\'Auxiliaire Spécialisé Vétérinaire'
                )
            ])
            ->add('isEmergency', ChoiceType::class, [
                'label' => "Etes-vous vétérinaire de garde ?",
                'choices' => [
                    'Oui' => true,
                    'Non' => false,
                ],
                'multiple' => false,
            ])
            ->add('experience', TextareaType::class, [
                'label' => 'Décrivez vos expériences',
                'required' => false,
                'attr' => array(
                    'placeholder' => 'Détaillez vos expériences professionnelles'
                )
            ])
            ->add('sex', ChoiceType::class, [
                'choices' => [
                    'Homme' => 'male',
                    'Femme' => 'female',
                ],
                'multiple' => false,
                'label' => 'Sexe',
                'attr' => array(
                    'class' => ''
                )
            ])
            ->add('nameSlug', TextType::class, [
                'disabled' => true,
                'label' => 'Votre lien personnalisé',
            ])
            ->add('animalTypes', EntityType::class, [
                'class' => AnimalType::class,
                'choice_label' => 'type_name',
                'multiple' => true,
                'expanded' => true,
                'label' => 'Les animaux que vous acceptés en tant que patients',
            ])
            ->add('cityId', EntityType::class, [
                'class' => City::class,
                'choice_label' => 'city_name',
                'label' => 'Ville de votre travail',
            ])
            ->add('services', EntityType::class, [
                'class' => Service::class,
                'choice_label' => 'service_name',
                'multiple' => true,
                'expanded' => true,
                'label' => 'Services proposés',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Doctor::class,
        ]);
    }
}
