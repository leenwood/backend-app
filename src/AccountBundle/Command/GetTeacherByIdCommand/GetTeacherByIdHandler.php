<?php

namespace App\AccountBundle\Command\GetTeacherByIdCommand;

use App\AccountBundle\Entity\Account;
use App\AccountBundle\Exception\AccountNotTeacherException;
use App\AccountBundle\Service\MainUserService;

class GetTeacherByIdHandler
{
    public function __construct(
        private MainUserService $mainUserService
    )
    {
    }


    /**
     * @param GetTeacherByIdCommand $command
     * @return Account
     * @throws AccountNotTeacherException
     */
    public function __invoke(GetTeacherByIdCommand $command): Account
    {
        $account = $this->mainUserService->findById($command->id);

        if(in_array('ROLE_TEACHER', $account->getRoles()))
        {
            return $account;
        }
        throw new AccountNotTeacherException(sprintf("account with id: %s, not teacher.", $command->id));
    }


}