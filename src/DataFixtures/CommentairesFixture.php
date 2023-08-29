<?php

namespace App\DataFixtures;

use App\Entity\Commentaires;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CommentairesFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("fr_FR");
        for ($i = 0; $i < 15; $i++) {
            $commentaires = new Commentaires();
                $commentaires->setPseudo($faker->userName);
                $commentaires->setContenue($faker->sentences(3,true));
                $commentaires->setEmail($faker->email());
                $commentaires->setCreatedAt(new \DateTime());

                $note = rand(1, 5);
                $commentaires->setNote($note);

            $manager->persist($commentaires);
        }
        $manager->flush();
    }
}
