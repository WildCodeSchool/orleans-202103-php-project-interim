<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    /**
     * @Assert\Notblank(message="Le champ Prénom est obligatoire")
     * @Assert\Length(max=255)
     */
    private ?string $firstname;

    /**
     * @Assert\Notblank(message="Le champ Nom est obligatoire")
     * @Assert\Length(max=255, maxMessage="Le Prénom ne doit pas dépasser {{ limit }} caractères")
     */
    private ?string $lastname;

    /**
     * @Assert\Notblank(message="Le champ E-mail est obligatoire")
     * @Assert\Email()
     * @Assert\Length(max=255, maxMessage="Le nom ne doit pas dépasser {{ limit }} caractères")
     */
    private ?string $email;

    /**
     * @Assert\Notblank(message="Le champ Message est obligatoire")
     */
    private ?string $message;

     /**
     * @return null|string
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @return Contact
     */
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

     /**
     * @return null|string
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @return Contact
     */
    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return Contact
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @return Contact
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
