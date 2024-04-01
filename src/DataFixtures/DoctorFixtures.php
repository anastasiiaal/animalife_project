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
        $doctor1->setUserId($this->getReference('vet1'));
        $doctor1->setImagePath('https://plus.unsplash.com/premium_photo-1661576909413-2aba00848804?q=80&w=2970&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
        $doctor1->setCityId($this->getReference('Annecy'));
        $doctor1->setAddress('71 avenue des Alpes');
        $doctor1->setClinicName('Clinique des Alpes');
        $doctor1->setIsEmergency(true);
        $doctor1->addAnimalType($this->getReference('Chat'));
        $doctor1->addAnimalType($this->getReference('Chien'));
        $doctor1->addAnimalType($this->getReference('Lapin'));
        $doctor1->addService($this->getReference('service1'));
        $doctor1->addService($this->getReference('service2'));
        $doctor1->addService($this->getReference('service7'));
        $doctor1->addService($this->getReference('service9'));
        $manager->persist($doctor1);

        $doctor2 = new Doctor();
        $doctor2->setUserId($this->getReference('vet2'));
        $doctor2->setImagePath('https://resize.prod.docfr.doc-media.fr/s/1200/ext/eac4ff34/content/2022/7/3/choix-du-veterinaire-pour-son-chat-bd3069ab5b0f99c8.jpeg');
        $doctor2->setCityId($this->getReference('Annecy'));
        $doctor2->setAddress('9 rue Thomas Ruphy');
        $doctor2->setClinicName('Clinique Vétérinaire Lafayette');
        $doctor2->setIsEmergency(true);
        $doctor2->addAnimalType($this->getReference('Chat'));
        $doctor2->addAnimalType($this->getReference('Chien'));
        $doctor2->addAnimalType($this->getReference('Lapin'));
        $doctor2->addAnimalType($this->getReference('Lapin'));
        $doctor2->addAnimalType($this->getReference('Hamster'));
        $doctor2->addAnimalType($this->getReference('Rat'));
        $doctor2->addService($this->getReference('service1'));
        $doctor2->addService($this->getReference('service2'));
        $doctor2->addService($this->getReference('service3'));
        $doctor2->addService($this->getReference('service4'));
        $doctor2->addService($this->getReference('service6'));
        $doctor2->addService($this->getReference('service8'));
        $doctor2->addService($this->getReference('service9'));
        $manager->persist($doctor2);

        $doctor3 = new Doctor();
        $doctor3->setUserId($this->getReference('vet3'));
        $doctor3->setImagePath('https://f.maformation.fr/edito/sites/3/2021/08/veterinaire.jpeg');
        $doctor3->setCityId($this->getReference('Lyon'));
        $doctor3->setAddress('10 bd du Rhone');
        $doctor3->setClinicName('VetoClean');
        $doctor3->setIsEmergency(true);
        $doctor3->addAnimalType($this->getReference('Chat'));
        $doctor3->addAnimalType($this->getReference('Chien'));
        $doctor3->addAnimalType($this->getReference('Vache'));
        $doctor3->addAnimalType($this->getReference('Cheval'));
        $doctor3->addService($this->getReference('service1'));
        $doctor3->addService($this->getReference('service2'));
        $doctor3->addService($this->getReference('service5'));
        $doctor3->addService($this->getReference('service8'));
        $doctor3->addService($this->getReference('service10'));
        $manager->persist($doctor3);

        $manager->flush();

        $this->addReference('doctor1', $doctor1);
        $this->addReference('doctor2', $doctor2);
        $this->addReference('doctor3', $doctor3);
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            CityFixtures::class,
            AnimalTypeFixtures::class,
        ];
    }
}
