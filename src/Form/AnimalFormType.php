<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\AnimalType;
use App\Entity\PetOwner;
use App\Entity\Vaccination;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnimalFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => "Nom de l'animal",
                'attr' => array(
                    'class' => '',
                    'placeholder' => 'Minou'
                ),
            ])
            ->add('imagePath', FileType::class, [
                'label' => 'Image de votre animal',
                'required' => false,
                'mapped' => false,
                'attr' => array(
                    'class' => ''
                ),
            ])
            ->add('dateBirth', null, [
                'label' => 'Date ne naissance',
                'widget' => 'single_text',
                'attr' => array(
                    'class' => ''
                ),
            ])
            ->add('sex', ChoiceType::class, [
                'choices' => [
                    'Mâle' => 'male',
                    'Femelle' => 'female',
                ],
                'expanded' => true,
                'multiple' => false,
                'label' => 'Sexe',
                'attr' => array(
                    'class' => ''
                )
            ])
            ->add('isSterilized', ChoiceType::class, [
                'choices' => [
                    'Je ne sais pas' => null,
                    'Oui' => true,
                    'Non' => false,
                ],
                'expanded' => true,
                'multiple' => false,
                'label' => 'Sterilisé.e ?',
                'attr' => array(
                    'class' => ''
                ),
            ])
            ->add('allergy', TextType::class, [
                'label' => 'Allergies connues',
                'attr' => array(
                    'class' => '',
                    'placeholder' => 'e.g., Arachides, crustacés'
                ),
                'required' => false,
            ])
            ->add('additionalInfo', TextareaType::class, [
                'label' => 'Informations supplémentaires',
                'required' => false,
                'attr' => array(
                    'class' => '',
                    'placeholder' => 'e.g., Crises d\'épilepsie depuis l\'age de 3 mois'
                ),
            ])
            ->add('typeId', EntityType::class, [
                'class' => AnimalType::class,
                'choice_label' => 'typeName',
                'choice_value' => 'id',
                'label' => "Type d'animal"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
        ]);
    }
}
