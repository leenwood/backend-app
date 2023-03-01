<?php

namespace App\ApiBundle\Controller;

use App\AccountBundle\Entity\Account;
use App\AccountBundle\Repository\AccountRepository;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class TestController extends AbstractController
{
    public function __construct(
        private AccountRepository $accountRepository,
        private UserPasswordHasherInterface $hasher
    )
    {
    }

    #[Route(path: '/login/create/user')]
    public function createUser()
    {
        $account = new Account();
        $account->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
        $account->setPassword($this->hasher->hashPassword($account, 'Admin'));
        $account->setUsername('Admin');
        $this->accountRepository->save($account, true);
    }
}