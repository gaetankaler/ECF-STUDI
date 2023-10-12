<?php

namespace App\Entity;

use App\Repository\EmployeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;


#[ORM\Entity(repositoryClass:EmployeRepository::class)]
class Employe implements UserInterface, PasswordAuthenticatedUserInterface, \Serializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 60, unique: true)]
    private string $email;

    #[ORM\Column(type: "string", length: 100)]
    private string $password;

    #[ORM\Column(type: "datetime")]
    private \DateTimeInterface $date_enregistrement;

    private array $roles = [];

    public function __construct()
    {
        $this->date_enregistrement = new \DateTime();
        $this->roles = ['ROLE_EMPLOYE'];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getDateEnregistrement(): ?\DateTimeInterface
    {
        return $this->date_enregistrement;
    }

    public function setDateEnregistrement(\DateTimeInterface $dateEnregistrement): self
    {
        $this->date_enregistrement = $dateEnregistrement;

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function getRoles(): array
    {
        return ["ROLE_EMPLOYE"];
        return $this->roles;

    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials(): void
    {
    }
        public function serialize()
    {
        return serialize([
            $this->id,
            $this->email,
            $this->password
        ]);
    }

    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->email,
            $this->password
        ) = unserialize($serialized, ["allowed_classes" => false]);
    }
}