<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\HoraireGarage;

class HoraireGarageFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $joursSemaine = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];

        foreach ($joursSemaine as $jour) {
            $horaire = new HoraireGarage();
            $horaire->setJour($jour);
            $horaire->setOuvertureMatin('08:00');
            $horaire->setFermetureMatin('12:00');
            $horaire->setOuvertureApresMidi('13:00');
            $horaire->setFermetureApresMidi('18:00');

            $manager->persist($horaire);
        }

        $manager->flush();
    }
}
