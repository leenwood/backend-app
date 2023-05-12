<?php

namespace App\AccountBundle\Command\RegisterNewAccountCommand;

class RegisterNewAccountCommand
{
    /**
     * @var string
     */
    public string $name;
    /**
     * @var string
     */
    public string $surname;
    /**
     * @var string|null
     */
    public ?string $patronymic;
    /**
     * @var string
     */
    public string $email;

    /**
     * @var string
     */
    public string $password;


    /**
     * @param string $name
     * @param string $surname
     * @param string|null $patronymic
     * @param string $email
     * @param string $password
     */
    public function __construct(
        string $name,
        string $surname,
        ?string $patronymic,
        string $email,
        string $password
    )
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->patronymic = $patronymic;
        $this->email = $email;
        $this->password = $password;
    }

}