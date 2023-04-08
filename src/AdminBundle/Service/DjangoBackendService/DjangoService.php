<?php

namespace App\AdminBundle\Service\DjangoBackendService;

use App\AdminBundle\Exception\DjangoServiceException\ServerErrorException;
use App\AdminBundle\Service\DjangoBackendService\DTO\VacanciesListResponse;

class DjangoService
{
    public function __construct(
        private RequestService $requestService
    )
    {
    }


    public function getVacanciesListByName(string $name): VacanciesListResponse
    {
        try {
            return $this->requestService->getVacanciesListByName($name);
        } catch (ServerErrorException $e) {
            throw new ServerErrorException("Django Service: Problems with the external django service. \n ".$e->getMessage());
        }
    }
}