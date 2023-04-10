<?php

namespace App\AccountBundle\Command\CheckUserCommand;

use App\AccountBundle\Service\MainUserService;

class CheckUserHandler
{
    public function __construct(
        private MainUserService $mainUserService
    )
    {
    }


    /**
     * @param CheckUserCommand $checkUserCommand
     * @return bool
     */
    public function __invoke(CheckUserCommand $checkUserCommand): bool
    {
        $user = $this->mainUserService->findByUsername($checkUserCommand->username);
        if(is_null($user))
        {
            return false;
        }

        return $this->mainUserService->checkUserByPassword($user, $checkUserCommand->password);
    }


}