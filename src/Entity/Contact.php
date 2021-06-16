<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    /**
     * @Assert\NotBlank(message="Le champ Prénom est obligatoire")
     * @Assert\Length(max=255, maxMessage="Le prénom ne doit pas dépasser {{ limit }} caractères")
     */
    private ?string $firstname;

    /**
     * @Assert\NotBlank(message="Le champ Nom est obligatoire")
     * @Assert\Length(max=255, maxMessage="Le nom ne doit pas dépasser {{ limit }} caractères")
     */
    private ?string $lastname;

    /**
     * @Assert\NotBlank(message="Le champ Email est obligatoire")
     * @Assert\Email(message = "L'adresse '{{ value }}' n'est pas une adresse mail valide.")
     * @Assert\Length(max="100", maxMessage="L'adresse mail ne doit pas dépasser {{ limit }} caractères")
     */
    private ?string $email;

    /**
     * @Assert\NotBlank(message="Le champ Message est obligatoire")
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
