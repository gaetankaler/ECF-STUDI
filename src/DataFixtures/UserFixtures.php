<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

public function load(ObjectManager $manager)
{
    $user = new User();
    $user->setUsername('admin');

    $password = $this->hasher->hashPassword($user, 'pass_1234');
    $user->setPassword($password);

    $user->setRoles(['ROLE_ADMIN']);

    $manager->persist($user);
    $manager->flush();
}
}