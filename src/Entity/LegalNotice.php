<?php

namespace App\Entity;

use App\Repository\LegalNoticeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=LegalNoticeRepository::class)
 */
class LegalNotice
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Veuillez remplir ce champ s'il vous plait")
     */
    private string $text;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez remplir ce champ s'il vous plait")
     * @Assert\Length(max=255,
     * maxMessage = "Le titre ne peut pas dépasser {{ limit }} caractères")
     */
    private string $title;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }
}
