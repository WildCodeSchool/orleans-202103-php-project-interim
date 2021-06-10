<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    /**
     * @Assert\Notblank()
     * @Assert\Length(max=255)
     */
    private ?string $firstname;

    /**
     * @Assert\Notblank()
     * @Assert\Length(max=255)
     */
    private ?string $lastname;

    /**
     * @Assert\Notblank()
     * @Assert\Email()
     * @Assert\Length(max=255)
     */
    private ?string $email;

    /**
     * @Assert\Notblank()
     * @Assert\Length(max=255)
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
