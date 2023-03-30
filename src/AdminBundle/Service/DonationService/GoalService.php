<?php

namespace App\AdminBundle\Service\DonationService;

use App\AdminBundle\Entity\Goal;
use App\AdminBundle\Exception\NotFoundException;
use App\AdminBundle\Repository\GoalRepository;

class GoalService
{
    /**
     * @param GoalRepository $goalRepository
     */
    public function __construct(
        private GoalRepository $goalRepository
    )
    {
    }


    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->goalRepository->findAll();
    }

    /**
     * @param int $id
     * @return Goal
     * @throws NotFoundException
     */
    public function findById(int $id): Goal
    {
        $goal = $this->goalRepository->findOneBy(['id' => $id]);
        if(is_null($goal)) {
            throw new NotFoundException("Goal with id ".$id.". Not found");
        }
        return $goal;
    }
}