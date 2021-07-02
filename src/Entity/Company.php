<?php

namespace App\Entity;

use App\Entity\Job;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CompanyRepository::class)
 */
class Company
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
     * maxMessage = "Le nom de l'entreprise ne peut pas dépasser {{ limit }} caractères")
     */
    private string $companyName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez remplir ce champ s'il vous plait")
     * @Assert\Length(
     * max=255,
     * maxMessage = "La raison sociale ne peut pas dépasser {{ limit }} caractères")
     */
    private string $socialReason;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\NotBlank(message="Veuillez remplir ce champ s'il vous plait")
     * @Assert\Length(
     * min=14,
     * max=14,
     * minMessage = "Le numéro de siret doit contenir {{ limit }} caractères")
     *maxMessage = "Le numéro de siret ne peut pas dépasser {{ limit }} caractères")
     */
    private string $siret;

    /**
     * @ORM\OneToMany(targetEntity=Job::class, mappedBy="company", cascade={"persist", "remove"})
     */
    private Collection $jobs;

    /**
     * @ORM\OneToOne(targetEntity=User::class, mappedBy="company", cascade={"persist", "remove"})
     */
    private ?User $user;

    public function __construct()
    {
        $this->jobs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): self
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getSocialReason(): ?string
    {
        return $this->socialReason;
    }

    public function setSocialReason(string $socialReason): self
    {
        $this->socialReason = $socialReason;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    /**
     * @return Collection|Job[]
     */
    public function getJobs(): Collection
    {
        return $this->jobs;
    }

    public function addJob(Job $job): self
    {
        if (!$this->jobs->contains($job)) {
            $this->jobs[] = $job;
            $job->setCompany($this);
        }

        return $this;
    }

    public function removeJob(Job $job): self
    {
        if ($this->jobs->removeElement($job)) {
            // set the owning side to null (unless already changed)
            if ($job->getCompany() === $this) {
                $job->setCompany(null);
            }
        }

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
            $this->user->setCompany(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getCompany() !== $this) {
            $user->setCompany($this);
        }

        $this->user = $user;

        return $this;
    }

    public function __serialize(): array
    {
        return [];
    }
}
