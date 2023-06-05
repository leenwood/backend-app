<?php

namespace App\AccountBundle\Entity;

use App\AccountBundle\Repository\UserFieldsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserFieldsRepository::class)]
class UserFields
{

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private ?int $id = null;


    #[ORM\OneToOne(inversedBy: "userFields", targetEntity: Account::class)]
    #[ORM\JoinColumn(name: "account_id", referencedColumnName: "id")]
    private ?Account $account = null;

    #[ORM\Column(type: "string")]
    private ?string $name = null;

    #[ORM\Column(type: "string", nullable: true)]
    private ?string $patronymic = null;

    #[ORM\Column(type: "string")]
    private ?string $surname = null;

    #[ORM\Column(type: "string")]
    private ?string $email = null;

    #[ORM\Column(type: "string", nullable: true)]
    private ?string $studentIDNumber = null;

    #[ORM\Column(type: "string", nullable: true)]
    private ?string $studentGroup = null;

    #[ORM\Column(type: "string", nullable: true)]
    private ?string $educationalDirection = null;



    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Account|null
     */
    public function getAccount(): ?Account
    {
        return $this->account;
    }

    /**
     * @param Account|null $account
     */
    public function setAccount(?Account $account): void
    {
        $this->account = $account;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getPatronymic(): ?string
    {
        return $this->patronymic;
    }

    /**
     * @param string|null $patronymic
     */
    public function setPatronymic(?string $patronymic): void
    {
        $this->patronymic = $patronymic;
    }

    /**
     * @return string|null
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }

    /**
     * @param string|null $surname
     */
    public function setSurname(?string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getStudentIDNumber(): ?string
    {
        return $this->studentIDNumber;
    }

    /**
     * @param string|null $studentIDNumber
     */
    public function setStudentIDNumber(?string $studentIDNumber): void
    {
        $this->studentIDNumber = $studentIDNumber;
    }

    /**
     * @return string|null
     */
    public function getStudentGroup(): ?string
    {
        return $this->studentGroup;
    }

    /**
     * @param string|null $studentGroup
     */
    public function setStudentGroup(?string $studentGroup): void
    {
        $this->studentGroup = $studentGroup;
    }

    /**
     * @return string|null
     */
    public function getEducationalDirection(): ?string
    {
        return $this->educationalDirection;
    }

    /**
     * @param string|null $educationalDirection
     */
    public function setEducationalDirection(?string $educationalDirection): void
    {
        $this->educationalDirection = $educationalDirection;
    }


}