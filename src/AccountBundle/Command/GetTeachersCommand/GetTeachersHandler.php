<?php

namespace App\AccountBundle\Command\GetTeachersCommand;

use App\AccountBundle\Service\MainUserService;

class GetTeachersHandler
{
    public function __construct(
        private MainUserService $mainUserService
    )
    {
    }

    public function __invoke(GetTeachersCommand $command): array
    {
        return $this->mainUserService->getTeacherAccount();
    }


}