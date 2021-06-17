<?php

namespace App\Entity;

use DateTimeInterface;
use App\Entity\Company;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\JobRepository;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez remplir ce champ s'il vous plait")
     * @Assert\Length(
     * max=255,
     * maxMessage = "Le nom du poste ne peut pas dépasser {{ limit }} caractères")
     */
    private string $post;

    /**
     * @ORM\Column(type="date")
     */
    private DateTimeInterface $registeredAt;

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
     * @Assert\NotBlank(message="Veuillez remplir ce champ s'il vous plait")
     * @Assert\Positive
     */
    private int $hoursAWeek;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez remplir ce champ s'il vous plait")
     * @Assert\Length(
     * max=255,
     * maxMessage = "Le nom de la ville ne peut pas dépasser {{ limit }} caractères")
     */
    private string $city;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez remplir ce champ s'il vous plait")
     * @Assert\Length(
     * max=5,
     * maxMessage = "Le Code postal ne peut pas dépasser {{ limit }} caractères")
     */
    private string $postalCode;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Veuillez remplir ce champ s'il vous plait")
     */
    private string $description;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="jobs")
     */
    private ?Company $company;

    /**
     * @ORM\ManyToOne(targetEntity=StudyField::class, inversedBy="jobs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $studyField;

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

    public function getRegisteredAt(): ?\DateTimeInterface
    {
        return $this->registeredAt;
    }

    public function setRegisteredAt(\DateTimeInterface $registeredAt): self
    {
        $this->registeredAt = $registeredAt;

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

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): self
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

    public function getStudyField(): ?StudyField
    {
        return $this->studyField;
    }

    public function setStudyField(?StudyField $studyField): self
    {
        $this->studyField = $studyField;

        return $this;
    }
}
