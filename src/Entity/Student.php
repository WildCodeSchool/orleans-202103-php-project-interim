<?php

namespace App\Entity;

use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\StudentRepository;
use DateTime;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 * @Vich\Uploadable
 */
class Student
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Veuillez remplir ce champ s'il-vous-plait")
     * @Assert\Length(
     * max=255,
     * maxMessage = "Le niveau d'étude ne peut pas dépasser {{ limit }} caractères")
     */
    private ?string $level;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private ?DateTimeInterface $birthdate;

    /**
     * @ORM\OneToOne(targetEntity=User::class, mappedBy="student", cascade={"persist", "remove"})
     */
    private ?User $user;

    /**
     * @ORM\ManyToOne(targetEntity=StudyField::class, inversedBy="students")
     */
    private ?StudyField $studyField;

    /**
     * @ORM\Column(type="string", length=255 ,nullable=true)
     */
    private ?string $resume;

    /**
     * @Vich\UploadableField(mapping="resume", fileNameProperty="resume")
     * @var File|null
     */
    private ?File $resumeFile = null;

    /**
     * @ORM\Column(type="string", length=255 ,nullable=true)
     */
    private ?string $coverLetter;

    /**
     * @Vich\UploadableField(mapping="coverLetter", fileNameProperty="coverLetter")
     * @var File|null
     */
    private ?File $coverLetterFile = null;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTimeInterface $updatedAt;

    public function __serialize(): array
    {
        return [];
    }
    public function setResumeFile(File $resume = null): void
    {
        $this->resumeFile = $resume;
        if ($resume) {
            $this->updatedAt = new DateTimeImmutable();
        }
    }

    public function getResumeFile(): ?File
    {
        return $this->resumeFile;
    }

    public function setCoverLetterFile(File $coverLetter = null): void
    {
        $this->coverLetterFile = $coverLetter;
        if ($coverLetter) {
            $this->updatedAt = new DateTimeImmutable();
        }
    }

    public function getCoverLetterFile(): ?File
    {
        return $this->coverLetterFile;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(string $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(?\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setStudent(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getStudent() !== $this) {
            $user->setStudent($this);
        }

        $this->user = $user;

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

    /**
     * @return null|string
     */
    public function getResume(): ?string
    {
        return $this->resume;
    }

    /**
     * Set the value of resume
     *
     */
    public function setResume(?string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    /**
     * Get the value of coverLetter
     * @return null|string
     */
    public function getCoverLetter(): ?string
    {
        return $this->coverLetter;
    }

    /**
     * Set the value of coverLetter
     *
     */
    public function setCoverLetter(?File $coverLetter): self
    {
        $this->coverLetter = $coverLetter;

        return $this;
    }

    /**
     * Get the value of updatedAt
     */
    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * Set the value of updatedAt
     *
     */
    public function setUpdatedAt(?DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
