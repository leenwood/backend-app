<?php

namespace App\ApiBundle\Controller;

use App\AccountBundle\Command\GetTeacherByIdCommand\GetTeacherByIdCommand;
use App\AccountBundle\Command\GetTeacherByIdCommand\GetTeacherByIdHandler;
use App\AccountBundle\Command\GetTeachersCommand\GetTeachersCommand;
use App\AccountBundle\Command\GetTeachersCommand\GetTeachersHandler;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

#[Route('api/directions/', name: 'app_api_')]
class DirectionsController extends AbstractFOSRestController
{
    /**
     * @param GetTeachersHandler $getTeachersHandler
     * @param GetTeacherByIdHandler $getTeacherByIdHandler
     */
    public function __construct(
        private GetTeachersHandler $getTeachersHandler,
        private GetTeacherByIdHandler $getTeacherByIdHandler
    )
    {
    }


    #[Rest\Get(path: 'teachers', name: 'teachers_get')]
    public function getTeachers(): Response
    {
        return $this->handleView($this->view(($this->getTeachersHandler)(new GetTeachersCommand())));
    }

    #[Rest\Get(path: 'teacher/{id}', name: 'teacher_get_by_id')]
    public function getTeacher(
        int $id
    ): Response
    {
        return $this->handleView($this->view(($this->getTeacherByIdHandler)(new GetTeacherByIdCommand($id))));
    }

    #[Rest\Get(path: 'me', name: 'user_by_token')]
    public function getUserByToken(
        TokenStorageInterface $token
    )
    {
        return $this->handleView($this->view($token->getToken()->getUser()));
    }
}