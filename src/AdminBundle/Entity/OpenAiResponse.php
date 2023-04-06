<?php

namespace App\AdminBundle\Entity;

use App\AdminBundle\Repository\OpenAiResponseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OpenAiResponseRepository::class)]
class OpenAiResponse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    #[ORM\Column(type: 'text')]
    private ?string $input = null;

    #[ORM\Column]
    private ?array $competencies = [];

    #[ORM\Column]
    private ?array $profession = [];

    #[ORM\Column(type: 'text')]
    private ?string $courseName = null;

    /**
     * @return string|null
     */
    public function getCourseName(): ?string
    {
        return $this->courseName;
    }

    /**
     * @param string|null $courseName
     */
    public function setCourseName(?string $courseName): void
    {
        $this->courseName = $courseName;
    }

    /**
     * @return string|null
     */
    public function getInput(): ?string
    {
        return $this->input;
    }

    /**
     * @param string|null $input
     */
    public function setInput(?string $input): void
    {
        $this->input = $input;
    }

    /**
     * @return array
     */
    public function getCompetencies(): array
    {
        return $this->competencies;
    }

    /**
     * @param array $competencies
     */
    public function setCompetencies(array $competencies): void
    {
        $this->competencies = $competencies;
    }

    /**
     * @return array
     */
    public function getProfession(): array
    {
        return $this->profession;
    }

    /**
     * @param array|null $profession
     */
    public function setProfession(?array $profession): void
    {
        $this->profession = $profession;
    }


}
