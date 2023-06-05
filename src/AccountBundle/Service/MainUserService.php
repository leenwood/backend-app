<?php

namespace App\AccountBundle\Service;

use App\AccountBundle\Entity\Account;
use App\AccountBundle\Entity\UserFields;
use App\AccountBundle\Exception\IncorrectValueException;
use App\AccountBundle\Repository\AccountRepository;
use App\AccountBundle\Repository\UserFieldsRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class MainUserService
{

    private TranslatorService $translatorService;

    /**
     * @param AccountRepository $accountRepository
     * @param UserFieldsRepository $userFieldsRepository
     * @param UserPasswordHasherInterface $hasher
     * @param LoggerInterface $logger
     */
    public function __construct(
        private AccountRepository           $accountRepository,
        private UserFieldsRepository        $userFieldsRepository,
        private UserPasswordHasherInterface $hasher,
        private LoggerInterface             $logger,
    )
    {
        $this->translatorService = TranslatorService::getInstance();
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

    /**
     * @param string $name
     * @param string $surname
     * @param string|null $patronymic
     * @param string $email
     * @param string $password
     * @return bool
     * @throws IncorrectValueException
     */
    public function registerNewUser(
        string  $name,
        string  $surname,
        ?string $patronymic,
        string  $email,
        string  $password
    ): ?Account
    {


        if (preg_match("/[А-Яа-я]/", $email)) {
            $this->logger->error("UserService | Incorrect email value exception: " . $email);
            throw new IncorrectValueException("Incorrect email value exception: " . $email);
        }
        #создаем поля для пользователя
        $userFields = new UserFields();
        $userFields->setName($name);
        $userFields->setSurname($surname);
        $userFields->setPatronymic($patronymic);
        $userFields->setEmail($email);


        $name = $this->translatorService->translate($name);
        $surname = $this->translatorService->translate($surname);
        $patronymic = $this->translatorService->translate($patronymic);

        #создаем аккаунт для авторизации
        $account = new Account();
        $account->setUsername($surname . '_' . $name);
        $account->setRoles(['ROLE_USER']);
        $account->setPassword($this->hasher->hashPassword($account, $password));

        //TODO переписать функцию сохранения, что б она возращала значение сохраненное и убрать строчку с поиском аккаунта.
        //TODO вообще все это переписать надо, сейчас просто срочно надо сделать
        try {
            $this->accountRepository->save($account, true);
            $account = $this->findByUsername($surname . '_' . $name);

            $userFields->setAccount($account);
            $this->userFieldsRepository->save($userFields);
            $userFields = $this->userFieldsRepository->findOneBy(['account' => $account]);

            $account->setUserFields($userFields);
            $this->accountRepository->save($account);
        } catch (\Exception $e) {
            $this->logger->error(sprintf("UserService | %s", $e));
            return null;
        }

        return $account;
    }


    /**
     * @return array
     */
    public function getTeacherAccount(): array
    {
        try {
            return $this->accountRepository->getAccountsByRole("ROLE_TEACHER");

        } catch (\Throwable $e)
        {
            dd($e);
        }
    }

    /**
     * @param int $id
     * @return Account
     */
    public function findById(int $id): Account
    {
        return $this->accountRepository->findOneBy(['id' => $id]);
    }

}