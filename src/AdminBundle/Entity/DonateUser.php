<?php

namespace App\AdminBundle\Entity;

use App\AdminBundle\Repository\DonateUserRepository;
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

    #[ORM\Column(type: 'integer')]
    private ?int $donateDate = null;
}