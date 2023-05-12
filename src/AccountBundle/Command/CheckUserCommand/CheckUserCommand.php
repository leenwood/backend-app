<?php

namespace App\AccountBundle\Command\CheckUserCommand;

class CheckUserCommand
{
    /** @var string  */
    public string $username;

    /** @var string  */
    public string $password;

    /**
     * @param string $username
     * @param string $password
     */
    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }
}