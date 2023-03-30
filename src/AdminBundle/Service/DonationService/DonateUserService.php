<?php

namespace App\AdminBundle\Service\DonationService;

use App\AdminBundle\Entity\DonateUser;
use App\AdminBundle\Entity\Goal;
use App\AdminBundle\Repository\DonateUserRepository;

class DonateUserService
{
    /**
     * @param DonateUserRepository $donateUserRepository
     */
    public function __construct(
        private DonateUserRepository $donateUserRepository
    )
    {
    }


    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->donateUserRepository->findAll();
    }

    public function getUserByGoal(Goal $goal): array
    {
        return $this->donateUserRepository->getDonationUsersByGoal($goal);
    }

}