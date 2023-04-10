<?php

namespace App\AccountBundle\Service;

use App\AccountBundle\Entity\Account;
use App\AccountBundle\Repository\AccountRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class MainUserService
{
    /**
     * @param AccountRepository $accountRepository
     * @param UserPasswordHasherInterface $hasher
     */
    public function __construct(
        private AccountRepository $accountRepository,
        private UserPasswordHasherInterface $hasher
    )
    {
    }

    /**
     * @param string $username
     * @return Account|null
     */
    public function findByUsername(string $username): ?Account
    {
        return $this->accountRepository->findOneBy(['username' => $username]);
    }

    /**
     * @param Account $account
     * @param string $password
     * @return bool
     */
    public function checkUserByPassword(Account $account, string $password): bool
    {
        return $this->hasher->isPasswordValid($account, $password);
    }

}