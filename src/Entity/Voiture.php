<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use App\Repository\VoitureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: VoitureRepository::class)]

class Voiture
{

    const MOTORISATION = [
        0 => "Diesel",
        1 => "Essence",
        2 => "Electique"
    ];
    const GPS = [
        0 => "Oui",
        1 => "Non"
    ];
    const CAMERA = [
        0 => "Oui",
        1 => "Non"
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\Column(length: 255)]
    private ?string $title;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description;


    #[ORM\Column]
    #[Assert\Range(min:1900, max:2023)]
    private ?int $annee;

    #[ORM\Column]
    #[Assert\Range(min:1, max:9999999)]
    private ?int $kilometrage;

    #[ORM\Column]
    #[Assert\Range(min:50, max:1000)]
    private ?int $chevaux;

    #[ORM\Column]
    #[Assert\Range(min:1, max:9999999)]
    private ?int $prix;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $detail = null;

    #[ORM\Column]
    #[Assert\Range(min:3, max:5)]

    private ?int $porte = null;

    #[ORM\Column(length: 255)]
    private ?string $motorisation = null;

    #[ORM\Column(length: 255)]
    private ?string $gps = null;

    #[ORM\Column(length: 255)]
    private ?string $camera = null;

    public function __construct() {
        $this->id = null;
        $this->date = new \DateTime();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }
    public function getSlug(): string
    {
        return (new Slugify())->slugify($this->title);
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): static
    {
        $this->annee = $annee;

        return $this;
    }

    public function getKilometrage(): ?int
    {
        return $this->kilometrage;
    }

    public function setKilometrage(int $kilometrage): static
    {
        $this->kilometrage = $kilometrage;

        return $this;
    }

    public function getChevaux(): ?int
    {
        return $this->chevaux;
    }

    public function setChevaux(int $chevaux): static
    {
        $this->chevaux = $chevaux;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getFormatPrix(): string
    { 
        return number_format($this->prix,0,""," ") . " €";
    }
    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getDetail(): ?string
    {
        return $this->detail;
    }

    public function setDetail(string $detail): static
    {
        $this->detail = $detail;

        return $this;
    }

    public function getPorte(): ?int
    {
        return $this->porte;
    }

    public function setPorte(int $porte): static
    {
        $this->porte = $porte;

        return $this;
    }

    public function getMotorisation(): ?int
    {
        return $this->motorisation;
    }

    public function setMotorisation(int $motorisation): static
    {
        $this->motorisation = $motorisation;

        return $this;
    }

    public function getGps(): ?int
    {
        return $this->gps;
    }

    public function setGps(int $gps): static
    {
        $this->gps = $gps;

        return $this;
    }

    public function getCamera(): ?int
    {
        return $this->camera;
    }

    public function setCamera(int $camera): static
    {
        $this->camera = $camera;

        return $this;
    }
}
