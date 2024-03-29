<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use App\DataFixtures\AnimalTypeFixtures;
use App\DataFixtures\PetOwnerFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AnimalFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $animal1 = new Animal();
        $animal1->setOwnerId($this->getReference('petOwner1'));
        $animal1->setName('Toto');
        $animal1->setSex('male');
        $animal1->setIsSterilized(false);
        $animal1->setTypeId($this->getReference('Chien'));
        $manager->persist($animal1);
        
        $animal2 = new Animal();
        $animal2->setOwnerId($this->getReference('petOwner1'));
        $animal2->setName('Luna');
        $animal2->setSex('female');
        $animal2->setIsSterilized(true);
        $animal2->setAllergy('Arachides');
        $animal2->setTypeId($this->getReference('Chat'));
        $manager->persist($animal2);
        
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AnimalTypeFixtures::class,
            PetOwnerFixtures::class,
        ];
    }
}