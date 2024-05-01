<?php

namespace App\Form;

use App\Entity\AnimalType;
use App\Entity\City;
use App\Entity\Doctor;
use App\Entity\Service;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DoctorFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imagePath')
            ->add('address')
            ->add('clinicName')
            ->add('education')
            ->add('isEmergency')
            ->add('experience')
            ->add('sex')
            ->add('nameSlug')
            ->add('userId', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('animalTypes', EntityType::class, [
                'class' => AnimalType::class,
                'choice_label' => 'type_name',
                'multiple' => true,
            ])
            ->add('cityId', EntityType::class, [
                'class' => City::class,
                'choice_label' => 'city_name',
            ])
            ->add('services', EntityType::class, [
                'class' => Service::class,
                'choice_label' => 'service_name',
                'multiple' => true,
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
