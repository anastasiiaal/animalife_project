<?php

namespace App\DataFixtures;

use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ServiceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $service1 = new Service();
        $service1->setServiceName('Vaccination');
        $manager->persist($service1);

        $service2 = new Service();
        $service2->setServiceName('Examen de santé annuel');
        $service2->setDescription('Contrôles réguliers pour surveiller la santé générale');
        $manager->persist($service2);

        $service3 = new Service();
        $service3->setServiceName('Conseils nutritionnels');
        $service3->setDescription('Recommandations alimentaires pour la santé optimale à différentes étapes de la vie');
        $manager->persist($service3);

        $service4 = new Service();
        $service4->setServiceName('Soins dentaires');
        $service4->setDescription('Nettoyage des dents, extractions dentaires, et autres soins bucco-dentaires');
        $manager->persist($service4);

        $service5 = new Service();
        $service5->setServiceName('Dermatologie');
        $manager->persist($service5);

        $service6 = new Service();
        $service6->setServiceName('Neurologie');
        $manager->persist($service6);

        $service7 = new Service();
        $service7->setServiceName('Stérilisation et castration');
        $manager->persist($service7);

        $service8 = new Service();
        $service8->setServiceName('Chirurgies générales');
        $manager->persist($service8);

        $service9 = new Service();
        $service9->setServiceName('Soins d\'urgence');
        $service9->setDescription('Traitement des urgences médicales, y compris les accidents, les empoisonnements, et les crises aiguës');
        $manager->persist($service9);

        $service10 = new Service();
        $service10->setServiceName('Accouchement et césarienne');
        $service10->setDescription('Assistance lors de l\'accouchement, y compris les césariennes si nécessaire');
        $manager->persist($service10);

        $manager->flush();

        $this->addReference('service1', $service1);
        $this->addReference('service2', $service2);
        $this->addReference('service3', $service3);
        $this->addReference('service4', $service4);
        $this->addReference('service5', $service5);
        $this->addReference('service6', $service6);
        $this->addReference('service7', $service7);
        $this->addReference('service8', $service8);
        $this->addReference('service9', $service9);
        $this->addReference('service10', $service10);
    }
}
