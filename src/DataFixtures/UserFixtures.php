<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1->setEmail('admin@gmail.com');
        $user1->setPassword($this->passwordHasher->hashPassword(
            $user1,
            'password123' // for test purposes ; will change later
        ));
        $user1->setFirstName('Alice');
        $user1->setLastName('Dupont');
        $user1->setPhone('0612345678');
        $user1->setRoles(["ROLE_ADMIN"]);
        $user1->setRoleId('0');
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail('owner@gmail.com');
        $user2->setPassword($this->passwordHasher->hashPassword(
            $user2,
            'password123' // for test purposes ; will change later
        ));
        $user2->setFirstName('Sophie');
        $user2->setLastName('Dias');
        $user2->setPhone('0622151413');
        $user2->setRoleId('1');
        $manager->persist($user2);

        $user3 = new User();
        $user3->setEmail('vet@gmail.com');
        $user3->setPassword($this->passwordHasher->hashPassword(
            $user3,
            'password123' // for test purposes ; will change later
        ));
        $user3->setFirstName('Christine');
        $user3->setLastName('Durand');
        $user3->setPhone('0645883313');
        $user3->setRoleId('2');
        $manager->persist($user3);

        $user4 = new User();
        $user4->setEmail('paul.veto@gmail.com');
        $user4->setPassword($this->passwordHasher->hashPassword(
            $user4,
            'password123' // for test purposes ; will change later
        ));
        $user4->setFirstName('Paul');
        $user4->setLastName('Hubert');
        $user4->setPhone('0610883313');
        $user4->setRoleId('2');
        $manager->persist($user4);

        $user5 = new User();
        $user5->setEmail('dr.martin@gmail.com');
        $user5->setPassword($this->passwordHasher->hashPassword(
            $user5,
            'password123' // for test purposes ; will change later
        ));
        $user5->setFirstName('Aline');
        $user5->setLastName('Martin');
        $user5->setPhone('0610885555');
        $user5->setRoleId('2');
        $manager->persist($user5);

        $manager->flush();

        $this->addReference('admin', $user1);
        $this->addReference('owner', $user2);
        $this->addReference('vet1', $user3);
        $this->addReference('vet2', $user4);
        $this->addReference('vet3', $user5);
    }
}
