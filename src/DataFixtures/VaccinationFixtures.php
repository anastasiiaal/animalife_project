<?php

namespace App\DataFixtures;

use App\Entity\Vaccination;
use App\DataFixtures\AnimalTypeFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class VaccinationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $vaccination1 = new Vaccination();
        $vaccination1->setTitle('Rage');
        $vaccination1->addAnimalType($this->getReference('Chien'));
        $vaccination1->addAnimalType($this->getReference('Chat'));
        $vaccination1->addAnimalType($this->getReference('Cheval'));
        $manager->persist($vaccination1);

        $vaccination2 = new Vaccination();
        $vaccination2->setTitle('Parvovirus');
        $vaccination2->addAnimalType($this->getReference('Chien'));
        $manager->persist($vaccination2);

        $vaccination3 = new Vaccination();
        $vaccination3->setTitle('Hépatite');
        $vaccination3->addAnimalType($this->getReference('Chien'));
        $manager->persist($vaccination3);

        $vaccination4 = new Vaccination();
        $vaccination4->setTitle('Calicivirus');
        $vaccination4->addAnimalType($this->getReference('Chat'));
        $manager->persist($vaccination4);

        $vaccination5 = new Vaccination();
        $vaccination5->setTitle('Leucose féline (FeLV)');
        $vaccination5->addAnimalType($this->getReference('Chat'));
        $vaccination5->setDescription('Pour les chats à risque, 2 injections suivies de rappels annuels');
        $manager->persist($vaccination5);

        $vaccination6 = new Vaccination();
        $vaccination6->setTitle('Tétanos');
        $vaccination6->addAnimalType($this->getReference('Cheval'));
        $vaccination6->setDescription('1 injection suivie de rappels tous les 2 à 3 ans');
        $manager->persist($vaccination6);

        $vaccination7 = new Vaccination();
        $vaccination7->setTitle('Myxomatose');
        $vaccination7->addAnimalType($this->getReference('Lapin'));
        $vaccination7->setDescription('1-2 injections annuelles');
        $manager->persist($vaccination7);

        $manager->flush();

        $this->addReference('Rage', $vaccination1);
        $this->addReference('Parvovirus', $vaccination2);
        $this->addReference('Hépatite', $vaccination3);
        $this->addReference('Calicivirus', $vaccination4);
    }

    public function getDependencies()
    {
        return [
            AnimalTypeFixtures::class
        ];
    }
}
