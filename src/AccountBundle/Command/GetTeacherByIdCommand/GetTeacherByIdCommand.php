<?php

namespace App\AccountBundle\Command\GetTeacherByIdCommand;

class GetTeacherByIdCommand
{
    public int $id;

    public function __construct(
        int $id
    )
    {
        $this->id = $id;
    }
}