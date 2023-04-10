<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SettingsRepository::class)]
class Settings
{

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $openAIApiKey = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }



    /**
     * @return string|null
     */
    public function getOpenAIApiKey(): ?string
    {
        return $this->openAIApiKey;
    }

    /**
     * @param string|null $openAIApiKey
     */
    public function setOpenAIApiKey(?string $openAIApiKey): void
    {
        $this->openAIApiKey = $openAIApiKey;
    }



}