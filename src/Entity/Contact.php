<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;


class Contact
{

    #[Assert\NotBlank()]
    #[Assert\Length(min:2, max:100)]
    private string|null $firstname;

    #[Assert\NotBlank()]
    #[Assert\Length(min:2, max:100)]
    private string|null $lastname;

    #[Assert\NotBlank()]
    #[Assert\Regex(pattern:"/[0-9]{10}/")]
    private string|null $phone;

    #[Assert\NotBlank()]
    #[Assert\Email]
    private string|null $email;

    #[Assert\NotBlank()]
    #[Assert\Length(min:10)]
    private string|null $message;

    private Voiture|null $voiture;



    /**
     * Get the value of firstname
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */ 
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */ 
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of phone
     */ 
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */ 
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of message
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */ 
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of voiture
     */ 
    public function getVoiture()
    {
        return $this->voiture;
    }

    /**
     * Set the value of voiture
     *
     * @return  self
     */ 
    public function setVoiture($voiture)
    {
        $this->voiture = $voiture;

        return $this;
    }
}