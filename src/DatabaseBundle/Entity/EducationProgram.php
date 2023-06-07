<?php

namespace App\DatabaseBundle\Entity;

use App\DatabaseBundle\Repository\EducationProgramRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EducationProgramRepository::class)]
class EducationProgram
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $specialty = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $university = null;

    #[ORM\OneToMany(mappedBy: 'educationProgram', targetEntity: Discipline::class)]
    private Collection $disciplines;

    public function __construct()
    {
        $this->disciplines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSpecialty(): ?int
    {
        return $this->specialty;
    }

    public function setSpecialty(?int $specialty): self
    {
        $this->specialty = $specialty;

        return $this;
    }

    public function getUniversity(): ?string
    {
        return $this->university;
    }

    public function setUniversity(?string $university): self
    {
        $this->university = $university;

        return $this;
    }

    /**
     * @return Collection<int, Discipline>
     */
    public function getDisciplines(): Collection
    {
        return $this->disciplines;
    }

    public function addDiscipline(Discipline $discipline): self
    {
        if (!$this->disciplines->contains($discipline)) {
            $this->disciplines->add($discipline);
            $discipline->setEducationProgram($this);
        }

        return $this;
    }

    public function removeDiscipline(Discipline $discipline): self
    {
        if ($this->disciplines->removeElement($discipline)) {
            // set the owning side to null (unless already changed)
            if ($discipline->getEducationProgram() === $this) {
                $discipline->setEducationProgram(null);
            }
        }

        return $this;
    }
}
