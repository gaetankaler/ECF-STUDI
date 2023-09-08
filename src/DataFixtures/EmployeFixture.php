<?php

namespace App\DataFixtures;

use App\Entity\Employe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EmployeFixture extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $employe = new Employe();
            $employe->setEmail("employe$i@example.com");

            $password = $this->hasher->hashPassword($employe, 'pass_1234');
            $employe->setPassword($password);

            $employe->setRoles(['ROLE_USER']);


            $manager->persist($employe);
            $manager->flush();
        }
    }
}