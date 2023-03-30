<?php

namespace App\AdminBundle\Entity;

use App\AdminBundle\Repository\DonateUserRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DonateUserRepository::class)]
class DonateUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 100, unique: true)]
    private ?string $username = null;

    #[ORM\Column(type: 'datetime')]
    private ?DateTime $donateDate = null;

    #[ORM\Column(type: 'integer')]
    private ?int $donationSum = null;


    #[ORM\ManyToOne(targetEntity: Goal::class)]
    private ?Goal $goal;


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string|null $username
     */
    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return DateTime|null
     */
    public function getDonateDate(): ?DateTime
    {
        return $this->donateDate;
    }

    /**
     * @param DateTime|null $donateDate
     */
    public function setDonateDate(?DateTime $donateDate): void
    {
        $this->donateDate = $donateDate;
    }

    /**
     * @return int|null
     */
    public function getDonationSum(): ?int
    {
        return $this->donationSum;
    }

    /**
     * @param int|null $donationSum
     */
    public function setDonationSum(?int $donationSum): void
    {
        $this->donationSum = $donationSum;
    }

    /**
     * @return Goal|null
     */
    public function getGoal(): ?Goal
    {
        return $this->goal;
    }

    /**
     * @param Goal|null $goal
     */
    public function setGoal(?Goal $goal): void
    {
        $this->goal = $goal;
    }

}