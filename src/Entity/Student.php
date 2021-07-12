<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\StudentRepository;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=StudentRepository::class)
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

    public function __serialize(): array
    {
        return [];
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
}
