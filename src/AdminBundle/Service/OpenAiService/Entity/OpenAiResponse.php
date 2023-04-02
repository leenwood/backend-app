<?php

namespace App\AdminBundle\Service\OpenAiService\Entity;

use App\AdminBundle\Service\OpenAiService\Repository\OpenAiResponseRepository;
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

    #[ORM\Column(type: 'string')]
    private ?string $profession = null;

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
     * @return string|null
     */
    public function getProfession(): ?string
    {
        return $this->profession;
    }

    /**
     * @param string|null $profession
     */
    public function setProfession(?string $profession): void
    {
        $this->profession = $profession;
    }


}
