<?php

namespace App\ApiBundle\Controller;

use App\AccountBundle\Command\GetTeachersCommand\GetTeachersCommand;
use App\AccountBundle\Command\GetTeachersCommand\GetTeachersHandler;
use App\ApiBundle\Mock\TeachersMock;
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
     */
    public function __construct(
        private GetTeachersHandler $getTeachersHandler
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
        int $id,
        TeachersMock $teachersMock
    ): Response
    {
        return $this->handleView($this->view($teachersMock->getById($id)));
    }

    #[Rest\Get(path: 'me', name: 'user_by_token')]
    public function getUserByToken(
        TokenStorageInterface $token
    )
    {
        return $this->handleView($this->view($token->getToken()->getUser()));
    }
}