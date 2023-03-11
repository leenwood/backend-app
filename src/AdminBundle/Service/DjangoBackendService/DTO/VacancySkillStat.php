<?php

namespace App\AdminBundle\Service\DjangoBackendService\DTO;

class VacancySkillStat
{


    /**
     * @var string
     */
    private string $name;

    /**
     * @var int
     */
    private int $count;

    /**
     * @var float
     */
    private float $rate;

    /**
     * @param string $name
     * @param int $count
     * @param float $rate
     */
    public function __construct(
        string $name,
        int $count,
        float $rate
    )
    {
        $this->name = $name;
        $this->count = $count;
        $this->rate = $rate;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @return float
     */
    public function getRate(): float
    {
        return $this->rate;
    }


}