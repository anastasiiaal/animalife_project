<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\AnimalType;
use App\Entity\PetOwner;
use App\Entity\Vaccination;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnimalFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => "Type d'animal"
            ])
            ->add('imagePath')
            ->add('dateBirth', null, [
                'widget' => 'single_text',
            ])
            ->add('sex', ChoiceType::class, [
                'choices' => [
                    'Mâle' => 'male',
                    'Femelle' => 'female',
                ],
                'expanded' => true,  // pour faire radiobuttons
                'multiple' => false,  // avec une seule option
                'label' => 'Sexe',
            ])
            ->add('isSterilized', ChoiceType::class, [
                'choices' => [
                    'Oui' => 1,
                    'Non' => 0,
                    'Je ne sais pas' => null,
                ],
                'expanded' => true,
                'multiple' => false,
                'label' => 'Sterilisé.e ?',
                'placeholder' => false,
            ])
            ->add('allergy')
            ->add('additionalInfo')
            // ->add('ownerId', EntityType::class, [
            //     'class' => PetOwner::class,
            //     'choice_label' => 'id',
            // ])
            ->add('typeId', EntityType::class, [
                'class' => AnimalType::class,
                'choice_label' => 'typeName',
                'choice_value' => 'id',
                'label' => "Type d'animal"
            ])
            // ->add('vaccinations', EntityType::class, [
            //     'class' => Vaccination::class,
            //     'choice_label' => 'title',
            //     'multiple' => true,
            //     'expanded' => true,
            //     'label' => "Vaccinations"
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
        ]);
    }
}
