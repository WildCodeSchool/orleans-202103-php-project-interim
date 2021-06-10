<?php

namespace App\Entity;

use DateTimeInterface;
use App\Entity\Company;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\JobRepository;

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
    private int $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private string $post;

    /**
     * @ORM\Column(type="date")
     */
    private DateTimeInterface $registereAt;

    /**
     * @ORM\Column(type="date")
     */
    private DateTimeInterface $startAt;

    /**
     * @ORM\Column(type="date")
     */
    private DateTimeInterface $endAt;

    /**
     * @ORM\Column(type="integer")
     */
    private int $hoursAWeek;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $city;

    /**
     * @ORM\Column(type="integer")
     */
    private int $postalCode;

    /**
     * @ORM\Column(type="text")
     */
    private string $description;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="jobs")
     */
    private ?Company $company;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPost(): ?string
    {
        return $this->post;
    }

    public function setPost(string $post): self
    {
        $this->post = $post;

        return $this;
    }

    public function getRegistereAt(): ?\DateTimeInterface
    {
        return $this->registereAt;
    }

    public function setRegistereAt(\DateTimeInterface $registereAt): self
    {
        $this->registereAt = $registereAt;

        return $this;
    }

    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->startAt;
    }

    public function setStartAt(\DateTimeInterface $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->endAt;
    }

    public function setEndAt(\DateTimeInterface $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }

    public function getHoursAWeek(): ?int
    {
        return $this->hoursAWeek;
    }

    public function setHoursAWeek(int $hoursAWeek): self
    {
        $this->hoursAWeek = $hoursAWeek;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    public function setPostalCode(int $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }
}
