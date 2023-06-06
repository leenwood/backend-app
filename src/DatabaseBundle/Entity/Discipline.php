<?php

namespace App\DatabaseBundle\Entity;

use App\DatabaseBundle\Repository\DisciplineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DisciplineRepository::class)]
class Discipline
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $semester = null;

    #[ORM\OneToMany(mappedBy: 'discipline', targetEntity: Course::class)]
    private Collection $courses;

    #[ORM\ManyToOne(inversedBy: 'disciplines')]
    private ?EducationProgram $educationProgram = null;

    public function __construct()
    {
        $this->courses = new ArrayCollection();
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

    public function getSemester(): ?int
    {
        return $this->semester;
    }

    public function setSemester(?int $semester): self
    {
        $this->semester = $semester;

        return $this;
    }

    /**
     * @return Collection<int, Course>
     */
    public function getCourses(): Collection
    {
        return $this->courses;
    }

    public function addCourse(Course $course): self
    {
        if (!$this->courses->contains($course)) {
            $this->courses->add($course);
            $course->setDiscipline($this);
        }

        return $this;
    }

    public function removeCourse(Course $course): self
    {
        if ($this->courses->removeElement($course)) {
            // set the owning side to null (unless already changed)
            if ($course->getDiscipline() === $this) {
                $course->setDiscipline(null);
            }
        }

        return $this;
    }

    public function getEducationProgram(): ?EducationProgram
    {
        return $this->educationProgram;
    }

    public function setEducationProgram(?EducationProgram $educationProgram): self
    {
        $this->educationProgram = $educationProgram;

        return $this;
    }
}
