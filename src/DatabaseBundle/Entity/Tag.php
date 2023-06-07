<?php

namespace App\DatabaseBundle\Entity;

use App\DatabaseBundle\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TagRepository::class)]
class Tag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $class = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'tag', targetEntity: Course::class)]
    private Collection $course;

    #[ORM\ManyToMany(targetEntity: Quantity::class, inversedBy: 'tags')]
    private Collection $quantity;

    #[ORM\ManyToMany(targetEntity: Profession::class, mappedBy: 'tag')]
    private Collection $professions;

    public function __construct()
    {
        $this->course = new ArrayCollection();
        $this->quantity = new ArrayCollection();
        $this->professions = new ArrayCollection();
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

    public function getClass(): ?string
    {
        return $this->class;
    }

    public function setClass(string $class): self
    {
        $this->class = $class;

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

    /**
     * @return Collection<int, Course>
     */
    public function getCourse(): Collection
    {
        return $this->course;
    }

    public function addCourse(Course $course): self
    {
        if (!$this->course->contains($course)) {
            $this->course->add($course);
            $course->setTag($this);
        }

        return $this;
    }

    public function removeCourse(Course $course): self
    {
        if ($this->course->removeElement($course)) {
            // set the owning side to null (unless already changed)
            if ($course->getTag() === $this) {
                $course->setTag(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Quantity>
     */
    public function getQuantity(): Collection
    {
        return $this->quantity;
    }

    public function addQuantity(Quantity $quantity): self
    {
        if (!$this->quantity->contains($quantity)) {
            $this->quantity->add($quantity);
        }

        return $this;
    }

    public function removeQuantity(Quantity $quantity): self
    {
        $this->quantity->removeElement($quantity);

        return $this;
    }

    /**
     * @return Collection<int, Profession>
     */
    public function getProfessions(): Collection
    {
        return $this->professions;
    }

    public function addProfession(Profession $profession): self
    {
        if (!$this->professions->contains($profession)) {
            $this->professions->add($profession);
            $profession->addTag($this);
        }

        return $this;
    }

    public function removeProfession(Profession $profession): self
    {
        if ($this->professions->removeElement($profession)) {
            $profession->removeTag($this);
        }

        return $this;
    }
}
