<?php

namespace App\AdminBundle\Service\DjangoBackendService;


use App\AdminBundle\Service\DjangoBackendService\DTO\VacanciesListResponse;
use App\AdminBundle\Service\DjangoBackendService\DTO\VacancySkillStat;
use GuzzleHttp\Client;

class RequestService
{

    const BASE_URL = 'https://wheatleyhdd.pythonanywhere.com';

    const VACANCIES_LIST_BY_NAME_URI = '/private-api/skills_rate/?vacancies_name=';


    public function getVacanciesListByName(string $name): VacanciesListResponse
    {
        $client = new Client([
            'base_uri' => RequestService::BASE_URL
        ]);
        $response = $client->get(RequestService::VACANCIES_LIST_BY_NAME_URI.$name, []);
        $response = json_decode($response->getBody()->getContents(), true);
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