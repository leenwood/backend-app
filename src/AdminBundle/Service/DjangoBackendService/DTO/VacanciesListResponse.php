<?php

namespace App\AdminBundle\Service\DjangoBackendService\DTO;

class VacanciesListResponse
{

    /** @var int  */
    private int $vacanciesFound;

    /** @var VacancySkillStat[]  */
    private array $vacanciesStats;

    /** @var string[]  */
    private array $vacanciesNames;

    /**
     * @param int $vacanciesFound
     * @param VacancySkillStat[] $vacanciesStats
     * @param string[] $vacanciesNames
     */
    public function __construct(
        int $vacanciesFound,
        array $vacanciesStats,
        array $vacanciesNames
    )
    {
        $this->vacanciesFound = $vacanciesFound;
        $this->vacanciesStats = $vacanciesStats;
        $this->vacanciesNames = $vacanciesNames;
    }

    /**
     * @return int
     */
    public function getVacanciesFound(): int
    {
        return $this->vacanciesFound;
    }

    /**
     * @return array
     */
    public function getVacanciesStats(): array
    {
        return $this->vacanciesStats;
    }

    /**
     * @return array
     */
    public function getVacanciesNames(): array
    {
        return $this->vacanciesNames;
    }


}