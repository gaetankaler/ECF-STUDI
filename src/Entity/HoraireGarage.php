<?php

namespace App\Entity;

use App\Repository\HoraireGarageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HoraireGarageRepository::class)]
class HoraireGarage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $jour = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ouvertureMatin = null; // Heure d'ouverture le matin

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fermetureMatin = null; // Heure de fermeture le matin

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ouvertureApresMidi = null; // Heure d'ouverture l'après-midi

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fermetureApresMidi = null; // Heure de fermeture l'après-midi

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJour(): ?string
    {
        return $this->jour;
    }

    public function setJour(string $jour): static
    {
        $this->jour = $jour;

        return $this;
    }

    public function getOuvertureMatin(): ?string
    {
        return $this->ouvertureMatin;
    }

    public function setOuvertureMatin(?string $ouvertureMatin): static
    {
        $this->ouvertureMatin = $ouvertureMatin;

        return $this;
    }

    public function getFermetureMatin(): ?string
    {
        return $this->fermetureMatin;
    }

    public function setFermetureMatin(?string $fermetureMatin): static
    {
        $this->fermetureMatin = $fermetureMatin;

        return $this;
    }

    public function getOuvertureApresMidi(): ?string
    {
        return $this->ouvertureApresMidi;
    }

    public function setOuvertureApresMidi(?string $ouvertureApresMidi): static
    {
        $this->ouvertureApresMidi = $ouvertureApresMidi;

        return $this;
    }

    public function getFermetureApresMidi(): ?string
    {
        return $this->fermetureApresMidi;
    }

    public function setFermetureApresMidi(?string $fermetureApresMidi): static
    {
        $this->fermetureApresMidi = $fermetureApresMidi;

        return $this;
    }
}
