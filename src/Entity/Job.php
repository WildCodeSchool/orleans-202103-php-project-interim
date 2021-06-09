<?php

namespace App\Entity;

use App\Repository\JobRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private int $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private string $post;

    /**
     * @ORM\Column(type="date")
     */
    private mixed $registeredAt;

    /**
     * @ORM\Column(type="date")
     */
    private mixed $startAt;

    /**
     * @ORM\Column(type="date")
     */
    private mixed $endAt;

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
     * @ORM\JoinColumn(nullable=false)
     */
    private mixed $companyId;

    /**
     * @ORM\OneToMany(targetEntity=StudyField::class, mappedBy="job")
     */
    private mixed $studyFieldId;

    public function __construct()
    {
        $this->studyFieldId = new ArrayCollection();
    }

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

    public function getCompanyId(): ?Company
    {
        return $this->companyId;
    }

    public function setCompanyId(?Company $companyId): self
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * @return Collection|StudyField[]
     */
    public function getStudyFieldId(): Collection
    {
        return $this->studyFieldId;
    }

    public function addStudyFieldId(StudyField $studyFieldId): self
    {
        if (!$this->studyFieldId->contains($studyFieldId)) {
            $this->studyFieldId[] = $studyFieldId;
            $studyFieldId->setJob($this);
        }

        return $this;
    }

    public function removeStudyFieldId(StudyField $studyFieldId): self
    {
        if ($this->studyFieldId->removeElement($studyFieldId)) {
            // set the owning side to null (unless already changed)
            if ($studyFieldId->getJob() === $this) {
                $studyFieldId->setJob(null);
            }
        }

        return $this;
    }
}
