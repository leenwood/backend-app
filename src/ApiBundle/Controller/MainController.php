<?php

namespace App\ApiBundle\Controller;

use App\AccountBundle\Entity\Account;
use App\AccountBundle\Repository\AccountRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\SerializerBundle\JMSSerializerBundle;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class MainController extends AbstractFOSRestController
{


    #[Rest\Get("/api")]
    public function index(): Response
    {
        return $this->handleView($this->view(['welcome']));
    }
}