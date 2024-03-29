<?php

namespace App\DataFixtures;

use App\Entity\City;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CityFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        $city1 = new City();
        $city1->setCityName("Paris");
        $city1->setPostcode("75000");
        $manager->persist($city1);
        
        $city2 = new City();
        $city2->setCityName("Annecy");
        $city2->setPostcode("74000");
        $manager->persist($city2);

        $city3 = new City();
        $city3->setCityName("Bordeaux");
        $city3->setPostcode("33000");
        $manager->persist($city3);

        $city4 = new City();
        $city4->setCityName("Le Havre");
        $city4->setPostcode("76600");
        $manager->persist($city4);

        $city5 = new City();
        $city5->setCityName("Angers");
        $city5->setPostcode("49000");
        $manager->persist($city5);

        $city6 = new City();
        $city6->setCityName("Nîmes");
        $city6->setPostcode("30000");
        $manager->persist($city6);

        $city7 = new City();
        $city7->setCityName("Amiens");
        $city7->setPostcode("80000");
        $manager->persist($city7);

        $city8 = new City();
        $city8->setCityName("Avignon");
        $city8->setPostcode("84000");
        $manager->persist($city8);

        $city9 = new City();
        $city9->setCityName("Lyon");
        $city9->setPostcode("69000");
        $manager->persist($city9);

        $city9 = new City();
        $city9->setCityName("Marseille");
        $city9->setPostcode("13000");
        $manager->persist($city9);

        $city10 = new City();
        $city10->setCityName("Nice");
        $city10->setPostcode("06000");
        $manager->persist($city10);

        $city11 = new City();
        $city11->setCityName("Dijon"); 
        $city11->setPostcode("21000");
        $manager->persist($city11);

        $city12 = new City();
        $city12->setCityName("Besançon"); 
        $city12->setPostcode("25000");
        $manager->persist($city12);

        $city13 = new City();
        $city13->setCityName("Montbéliard");
        $city13->setPostcode("25200");
        $manager->persist($city13);

        $city14 = new City();
        $city14->setCityName("Strasbourg");
        $city14->setPostcode("67000");
        $manager->persist($city14);

        $city15 = new City();
        $city15->setCityName("Grenoble");
        $city15->setPostcode("38000");
        $manager->persist($city15);

        $city16 = new City();
        $city16->setCityName("Lille");
        $city16->setPostcode("59000");
        $manager->persist($city16);

        $city17 = new City();
        $city17->setCityName("Roubaix");
        $city17->setPostcode("59100");
        $manager->persist($city17);

        $city18 = new City();
        $city18->setCityName("Toulouse");
        $city18->setPostcode("31000");
        $manager->persist($city18);

        $city19 = new City();
        $city19->setCityName("Montpellier");
        $city19->setPostcode("34000");
        $manager->persist($city19);

        $manager->flush();

        $this->addReference('Paris', $city1);
        $this->addReference('Annecy', $city2);
        $this->addReference('Avignon', $city8);
        $this->addReference('Lyon', $city9);
        $this->addReference('Nice', $city10);
    }
}