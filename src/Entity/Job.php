<?php

namespace App\Entity;

use App\Repository\JobRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JobRepository::class)
 */
class Job
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $Post;

    /**
     * @ORM\Column(type="date")
     */
    private $RegistereAt;

    /**
     * @ORM\Column(type="date")
     */
    private $StartAt;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $EndAt;

    /**
     * @ORM\Column(type="integer")
     */
    private $HoursAWeek;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $City;

   /**
     * @ORM\Column(type="integer")
     */
    private $PostalCode;

    /**
     * @ORM\Column(type="text")
     */
    private $Description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPost(): ?string
    {
        return $this->Post;
    }

    public function setPost(string $Post): self
    {
        $this->Post = $Post;

        return $this;
    }

    public function getRegistereAt(): ?\DateTimeInterface
    {
        return $this->RegistereAt;
    }

    public function setRegistereAt(\DateTimeInterface $RegistereAt): self
    {
        $this->RegistereAt = $RegistereAt;

        return $this;
    }

    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->StartAt;
    }

    public function setStartAt(\DateTimeInterface $StartAt): self
    {
        $this->StartAt = $StartAt;

        return $this;
    }

    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->EndAt;
    }

    public function setEndAt(?\DateTimeInterface $EndAt): self
    {
        $this->EndAt = $EndAt;

        return $this;
    }

    public function getHoursAWeek(): ?int
    {
        return $this->HoursAWeek;
    }

    public function setHoursAWeek(int $HoursAWeek): self
    {
        $this->HoursAWeek = $HoursAWeek;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->City;
    }

    public function setCity(string $City): self
    {
        $this->City = $City;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->PostalCode;
    }

    public function setPostalCode(int $PostalCode): self
    {
        $this->PostalCode = $PostalCode;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }
}
