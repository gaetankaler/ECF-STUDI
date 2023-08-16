<?php

namespace App\DataFixtures;

use App\Entity\Voiture;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VoitureFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("fr_FR");
        for ($i = 0; $i < 30; $i++) {
            $voiture = new Voiture();
                $voiture->setTitle($faker->words(2,true));
                $voiture->setDescription($faker->sentences(3,true));
                $voiture->setAnnee($faker->numberBetween(1950,2023));
                $voiture->setKilometrage($faker->numberBetween(1,999999));
                $voiture->setChevaux($faker->numberBetween(50,1000));
                $voiture->setPrix($faker->numberBetween(1,40000));
                $voiture->setPorte($faker->randomElement(Voiture::PORTE));
                $voiture->setMotorisation($faker->randomElement(Voiture::MOTORISATION));
                $voiture->setGps($faker->randomElement(Voiture::GPS));
                $voiture->setCamera($faker->randomElement(Voiture::CAMERA));
                $voiture->setVisible(true);
                $voiture->setFilename("vide.jpg");
            $manager->persist($voiture);
        }
        $manager->flush();
    }
}
