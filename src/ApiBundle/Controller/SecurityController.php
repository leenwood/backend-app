<?php

namespace App\ApiBundle\Controller;

use App\AccountBundle\Command\CheckUserCommand\CheckUserCommand;
use App\AccountBundle\Command\CheckUserCommand\CheckUserHandler;
use App\AccountBundle\Command\RegisterNewAccountCommand\RegisterNewAccountCommand;
use App\AccountBundle\Command\RegisterNewAccountCommand\RegisterNewAccountHandler;
use App\AccountBundle\Exception\IncorrectValueException;
use App\AccountBundle\Exception\NotFoundAccountException;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

    #[Rest\Post('api/login', name: "app_api_login")]
    #[Rest\RequestParam(name: 'username', nullable: false)]
    #[Rest\RequestParam(name: 'password', nullable: false)]
    public function apiLogin(
        ParamFetcherInterface    $fetcher,
        JWTTokenManagerInterface $tokenManager
    ): Response
    {

        try {
            $account = ($this->checkUserHandler)(new CheckUserCommand(
                $fetcher->get('username'),
                $fetcher->get('password')
            ));
        } catch (NotFoundAccountException $e) {
            return $this->handleView($this->view([
                'success' => false,
                'exception' => sprintf('User with username %s not found', $fetcher->get('username')),
            ]));
        }

        return $this->handleView($this->view([
            'success' => true,
            'token' => $tokenManager->create($account)
        ]));

    }


    #[Rest\Post('api/registration', name: "app_api_registration")]
    #[Rest\RequestParam(name: 'name', nullable: false)]
    #[Rest\RequestParam(name: 'surname', nullable: false)]
    #[Rest\RequestParam(name: 'email', nullable: false)]
    #[Rest\RequestParam(name: 'patronymic', nullable: true)]
    #[Rest\RequestParam(name: 'password', nullable: false)]
    public function registration(
        ParamFetcherInterface    $fetcher,
        JWTTokenManagerInterface $tokenManager
    ): Response
    {

        try {
            $account = ($this->registerNewAccountHandler)(new RegisterNewAccountCommand(
                    $fetcher->get('name'),
                    $fetcher->get('surname'),
                    $fetcher->get('patronymic'),
                    $fetcher->get('email'),
                    $fetcher->get('password'),
                )
            );
        } catch (\Exception $e) {
            return $this->handleView($this->view([
                'success' => true,
                'exception' => 'Internal Server Error :('
            ]));
        }

        return $this->handleView($this->view([
            'success' => true,
            'token' => $tokenManager->create($account)
        ]));
    }
}