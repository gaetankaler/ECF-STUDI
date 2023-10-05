<?php

namespace App\Entity;

use App\Repository\CommentairesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentairesRepository::class)]
class Commentaires
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $contenue = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $pseudo = null;

    #[ORM\Column(type: "datetime")]
    private $created_at;


    #[ORM\Column(type: Types::INTEGER)]
    private int $note = 0;

    #[ORM\Column(type:"boolean")]
    private $valide = false;

    public function __construct()
    {
        $this->created_at = new \DateTime();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenue(): ?string
    {
        return $this->contenue;
    }

    public function setContenue(string $contenue): static
    {
        $this->contenue = $contenue;

        return $this;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): static
    {
        $this->pseudo = $pseudo;

        return $this;
    }
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }


    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
        public function getNote(): int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;
        return $this;
    }
        public function isValide(): bool
    {
        return $this->valide;
    }

    public function setValide(bool $valide): self
    {
        $this->valide = $valide;
        return $this;
    }

    /**
     * Get the value of valide
     */ 
    public function getValide()
    {
        return $this->valide;
    }
}   