<?php

namespace App\DataFixtures;

use App\Entity\Consultation;
use App\DataFixtures\AnimalFixtures;
use App\DataFixtures\DoctorFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ConsultationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $consultation1 = new Consultation();
        $consultation1->setAnimalId($this->getReference('animal1'));
        $consultation1->setDoctorId($this->getReference('doctor1'));
        $consultation1->setReason('Consultation de suivi annuelle');
        $consultation1->setResume('
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        ');

        $manager->persist($consultation1);
        
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AnimalFixtures::class,
            DoctorFixtures::class,
        ];
    }
}