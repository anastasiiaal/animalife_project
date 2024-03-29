<?php

namespace App\DataFixtures;

use App\Entity\AnimalType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AnimalTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $type1 = new AnimalType();
        $type1->setTypeName("Chat");
        $manager->persist($type1);
        
        $type2 = new AnimalType();
        $type2->setTypeName("Chien");
        $manager->persist($type2);
        
        $type3 = new AnimalType();
        $type3->setTypeName("Hamster");
        $manager->persist($type3);

        $type4 = new AnimalType();
        $type4->setTypeName("Oiseau");
        $manager->persist($type4);

        $type5 = new AnimalType();
        $type5->setTypeName("Cheval");
        $manager->persist($type5);

        $type6 = new AnimalType();
        $type6->setTypeName("Vache");
        $manager->persist($type6);

        $type7 = new AnimalType();
        $type7->setTypeName("Rat");
        $manager->persist($type7);

        $type8 = new AnimalType();
        $type8->setTypeName("Lapin");
        $manager->persist($type8);

        $manager->flush();

        $this->addReference('Chat', $type1);
        $this->addReference('Chien', $type2);
        $this->addReference('Hamster', $type3);
        $this->addReference('Oiseau', $type4);
        $this->addReference('Cheval', $type5);
        $this->addReference('Vache', $type6);
        $this->addReference('Rat', $type7);
        $this->addReference('Lapin', $type8);
    }
}