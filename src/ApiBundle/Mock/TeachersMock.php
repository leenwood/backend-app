<?php

namespace App\ApiBundle\Mock;

class TeachersMock
{

    private array $teachers;

    public function __construct()
    {
        $this->teachers = [
            '1' => [
                'name' => 'Илья',
                'surname' => 'Обабков',
                'patronymic' => 'Михайлович',
                'classroom' => 'Р-328',
                'address' => 'ул. Мира 32',
                'numberPhone' => '7343375-97-00',
                'email' => 'i.n.obabkov@urfu.ru',
                'description' => 'Руководитель образовательной програмы',
                'photoUrl' => 'https://rtf.urfu.ru/fileadmin/user_upload/site_19652/about_rtf/directors/directors_photo/ObabkovIN.jpg',
            ],
            '2' => [
                'name' => 'Илья',
                'surname' => 'Обабков',
                'patronymic' => 'Михайлович',
                'classroom' => 'Р-328',
                'address' => 'ул. Мира 32',
                'numberPhone' => '7343375-97-00',
                'email' => 'i.n.obabkov@urfu.ru',
                'description' => 'Руководитель образовательной програмы',
                'photoUrl' => 'https://rtf.urfu.ru/fileadmin/user_upload/site_19652/about_rtf/directors/directors_photo/ObabkovIN.jpg'
            ],
            '3' => [
                'name' => 'Илья',
                'surname' => 'Обабков',
                'patronymic' => 'Михайлович',
                'classroom' => 'Р-328',
                'address' => 'ул. Мира 32',
                'numberPhone' => '7343375-97-00',
                'email' => 'i.n.obabkov@urfu.ru',
                'description' => 'Руководитель образовательной програмы',
                'photoUrl' => 'https://rtf.urfu.ru/fileadmin/user_upload/site_19652/about_rtf/directors/directors_photo/ObabkovIN.jpg'
            ],
            '4' => [
                'name' => 'Илья',
                'surname' => 'Обабков',
                'patronymic' => 'Михайлович',
                'classroom' => 'Р-328',
                'address' => 'ул. Мира 32',
                'numberPhone' => '7343375-97-00',
                'email' => 'i.n.obabkov@urfu.ru',
                'description' => 'Руководитель образовательной програмы',
                'photoUrl' => 'https://rtf.urfu.ru/fileadmin/user_upload/site_19652/about_rtf/directors/directors_photo/ObabkovIN.jpg'
            ],
        ];
    }

    public function getAllTeachers(): array
    {
        return $this->teachers;
    }

    public function getById(int $id): array
    {

        return $this->teachers[$id];

    }
}