<?php

namespace App\ApiBundle\Controller;

use App\AccountBundle\Command\CheckUserCommand\CheckUserCommand;
use App\AccountBundle\Command\CheckUserCommand\CheckUserHandler;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends AbstractFOSRestController
{
    public function __construct(
        private CheckUserHandler $checkUserHandler
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
}