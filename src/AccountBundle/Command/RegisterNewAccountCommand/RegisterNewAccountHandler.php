<?php

namespace App\AccountBundle\Command\RegisterNewAccountCommand;

use App\AccountBundle\Exception\IncorrectValueException;
use App\AccountBundle\Service\MainUserService;

class RegisterNewAccountHandler
{
    /**
     * @param MainUserService $mainUserService
     */
    public function __construct(
        private MainUserService $mainUserService
    )
    {
    }


    /**
     * @param RegisterNewAccountCommand $command
     * @return bool
     * @throws IncorrectValueException
     */
    public function __invoke(RegisterNewAccountCommand $command): bool
    {
        return $this->mainUserService->registerNewUser(
            $command->name,
            $command->surname,
            $command->patronymic,
            $command->email,
            $command->password
        );
    }

}