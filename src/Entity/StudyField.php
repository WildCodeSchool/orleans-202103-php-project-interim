<?php

namespace App\Entity;

use App\Entity\Job;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\StudyFieldRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=StudyFieldRepository::class)
 */
class StudyField
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $studyFieldName;

    /**
     * @ORM\OneToMany(targetEntity=Job::class, mappedBy="studyField")
     */
    private Collection $jobs;

    public function __construct()
    {
        $this->jobs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudyFieldName(): ?string
    {
        return $this->studyFieldName;
    }

    public function setStudyFieldName(string $studyFieldName): self
    {
        $this->studyFieldName = $studyFieldName;

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
            $job->setStudyField($this);
        }

        return $this;
    }

    public function removeJob(Job $job): self
    {
        if ($this->jobs->removeElement($job)) {
            // set the owning side to null (unless already changed)
            if ($job->getStudyField() === $this) {
                $job->setStudyField(null);
            }
        }

        return $this;
    }
}
