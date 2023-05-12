<?php

namespace App\AccountBundle\Command\CheckUserCommand;

use App\AccountBundle\Entity\Account;
use App\AccountBundle\Exception\NotFoundAccountException;
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
     * @return Account|null
     * @throws NotFoundAccountException
     */
    public function __invoke(CheckUserCommand $checkUserCommand): ?Account
    {
        $user = $this->mainUserService->findByUsername($checkUserCommand->username);
        if(is_null($user))
        {
            throw new NotFoundAccountException();
        }

        if($this->mainUserService->checkUserByPassword($user, $checkUserCommand->password))
        {
            return $user;
        }

        return null;
    }


}