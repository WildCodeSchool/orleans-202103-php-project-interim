<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class QuotationRequest
{
    /**
     * @Assert\NotBlank(message="Le champ Société est obligatoire")
     * @Assert\Length(max="255", maxMessage="Le nom de la société ne doit pas dépasser {{ limit }} caractères")
     */
    private ?string $companyName;

    /**
     * @Assert\NotBlank(message="Le champ Contact est obligatoire")
     * @Assert\Length(max="255", maxMessage="Le nom du contact ne doit pas dépasser {{ limit }} caractères")
     */
    private ?string $contactName;

    /**
     * @Assert\NotBlank(message="Le champ Email est obligatoire")
     * @Assert\Length(max="100", maxMessage="L'adresse mail ne doit pas dépasser {{ limit }} caractères")
     * @Assert\Email(message = "L'adresse '{{ value }}' n'est pas une adresse mail valide.")
     */
    private ?string $email;

    /**
     * @Assert\NotBlank(message="Le champ Téléphone est obligatoire")
     * @Assert\Length(max="30", maxMessage="Le numéro de téléphone ne doit pas dépasser {{ limit }} caractères")
     */
    private ?string $phone;

    /**
     * @Assert\NotBlank(message="Le champ Message est obligatoire")
     */
    private ?string $message;

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): self
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getContactName(): ?string
    {
        return $this->contactName;
    }

    public function setContactName(string $contactName): self
    {
        $this->contactName = $contactName;

        return $this;
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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
