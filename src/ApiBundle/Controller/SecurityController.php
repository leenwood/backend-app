<?php

namespace App\ApiBundle\Controller;

use App\AccountBundle\Command\CheckUserCommand\CheckUserCommand;
use App\AccountBundle\Command\CheckUserCommand\CheckUserHandler;
use App\AccountBundle\Command\RegisterNewAccountCommand\RegisterNewAccountCommand;
use App\AccountBundle\Command\RegisterNewAccountCommand\RegisterNewAccountHandler;
use App\AccountBundle\Exception\IncorrectValueException;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends AbstractFOSRestController
{
    /**
     * @param CheckUserHandler $checkUserHandler
     * @param RegisterNewAccountHandler $registerNewAccountHandler
     */
    public function __construct(
        private CheckUserHandler          $checkUserHandler,
        private RegisterNewAccountHandler $registerNewAccountHandler
    )
    {
    }


    #[Rest\Post('api/login_check')]
    #[Rest\RequestParam(name: 'username', nullable: true)]
    #[Rest\RequestParam(name: 'password', nullable: true)]
    public function login(
        ParamFetcherInterface $fetcher
    )
    {
        $result = ($this->checkUserHandler)(new CheckUserCommand($fetcher->get('username'), $fetcher->get('password')));
        dd($result);
    }


    /**
     * @throws IncorrectValueException
     */
    #[Rest\Post('api/registration')]
    #[Rest\RequestParam(name: 'name', nullable: true)]
    #[Rest\RequestParam(name: 'surname', nullable: true)]
    #[Rest\RequestParam(name: 'email', nullable: true)]
    #[Rest\RequestParam(name: 'patronymic', nullable: true)]
    #[Rest\RequestParam(name: 'password', nullable: true)]
    public function registration(
        ParamFetcherInterface $fetcher
    )
    {
        $result = ($this->registerNewAccountHandler)(new RegisterNewAccountCommand(
            $fetcher->get('name'),
            $fetcher->get('surname'),
            $fetcher->get('patronymic'),
            $fetcher->get('email'),
            $fetcher->get('password'),
            )
        );
        dd($result);
    }
}