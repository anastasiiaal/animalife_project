<?php

namespace App\DataFixtures;

use App\Entity\Doctor;
use App\DataFixtures\UserFixtures;
use App\DataFixtures\CityFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class DoctorFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $doctor1 = new Doctor();
        $doctor1->setUserId($this->getReference('vet'));
        $doctor1->setImagePath('https://plus.unsplash.com/premium_photo-1661576909413-2aba00848804?q=80&w=2970&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
        $doctor1->setCityId($this->getReference('Annecy'));
        $doctor1->setAddress('71 avenue des Alpes');
        $doctor1->setClinicName('Clinique des Alpes');
        $doctor1->setIsEmergency(true);
        $manager->persist($doctor1);

        $manager->flush();

        $this->addReference('doctor1', $doctor1);
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            CityFixtures::class,
        ];
    }
}
