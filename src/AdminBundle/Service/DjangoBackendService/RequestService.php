<?php

namespace App\AdminBundle\Service\DjangoBackendService;


use App\AdminBundle\Exception\DjangoServiceException\NotFoundVacanciesException;
use App\AdminBundle\Exception\DjangoServiceException\ServerErrorException;
use App\AdminBundle\Service\DjangoBackendService\DTO\VacanciesListResponse;
use App\AdminBundle\Service\DjangoBackendService\DTO\VacancySkillStat;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ServerException;

class RequestService
{

    const BASE_URL = 'https://wheatleyhdd.pythonanywhere.com';

    const VACANCIES_LIST_BY_NAME_URI = '/private-api/skills_rate/';


    public function getVacanciesListByName(string $name): VacanciesListResponse
    {

        $client = new Client([
            'base_uri' => RequestService::BASE_URL
        ]);

        try {
            $response = $client->request('POST', RequestService::VACANCIES_LIST_BY_NAME_URI,
                [
                    'form_params' =>
                        ['vacancies_name' => $name]
                ]
            );

        } catch (ServerException $e) {
            throw new ServerErrorException(sprintf("Django Backend returned %s code", $e->getCode()));
        }


        $response = json_decode($response->getBody()->getContents(), true);

        if((int)$response['vacanciesFound'] <= 0) {
            throw new NotFoundVacanciesException();
        }

        $vacanciesStats = [];
        foreach ($response['vacanciesStats'] as $vacanciesStat) {
            $vacanciesStats[] = new VacancySkillStat(
                $vacanciesStat['name'],
                $vacanciesStat['count'],
                $vacanciesStat['rate']
            );
        }
        $response = new VacanciesListResponse(
            $response['vacanciesFound'],
            $vacanciesStats,
            $response['vacanciesNames']
        );
        return $response;
    }
}