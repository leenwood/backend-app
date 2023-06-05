<?php

namespace App\DatabaseBundle\Entity;

use App\DatabaseBundle\Repository\ProfessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfessionRepository::class)]
class Profession
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?int $vacancyCount = null;

    #[ORM\Column(nullable: true)]
    private ?int $averageSalary = null;

    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'professions')]
    private Collection $tag;

    public function __construct()
    {
        $this->tag = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getVacancyCount(): ?int
    {
        return $this->vacancyCount;
    }

    public function setVacancyCount(?int $vacancyCount): self
    {
        $this->vacancyCount = $vacancyCount;

        return $this;
    }

    public function getAverageSalary(): ?int
    {
        return $this->averageSalary;
    }

    public function setAverageSalary(?int $averageSalary): self
    {
        $this->averageSalary = $averageSalary;

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTag(): Collection
    {
        return $this->tag;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tag->contains($tag)) {
            $this->tag->add($tag);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        $this->tag->removeElement($tag);

        return $this;
    }
}
