<?php

namespace App\AccountBundle\Service;

# СИНГАЛТОН или же singleton

class TranslatorService
{

    /** @var array|string[] */
    private array $letters = [
        'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
        'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
        'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
        'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
        'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
        'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
        'э' => 'e',    'ю' => 'yu',   'я' => 'ya',

        'А' => 'A',    'Б' => 'B',    'В' => 'V',    'Г' => 'G',    'Д' => 'D',
        'Е' => 'E',    'Ё' => 'E',    'Ж' => 'Zh',   'З' => 'Z',    'И' => 'I',
        'Й' => 'Y',    'К' => 'K',    'Л' => 'L',    'М' => 'M',    'Н' => 'N',
        'О' => 'O',    'П' => 'P',    'Р' => 'R',    'С' => 'S',    'Т' => 'T',
        'У' => 'U',    'Ф' => 'F',    'Х' => 'H',    'Ц' => 'C',    'Ч' => 'Ch',
        'Ш' => 'Sh',   'Щ' => 'Sch',  'Ь' => '',     'Ы' => 'Y',    'Ъ' => '',
        'Э' => 'E',    'Ю' => 'Yu',   'Я' => 'Ya',
    ];

    private static $instance;

    /**
     * Защищаем от создания через new Singleton
     * @return TranslatorService
     */
    public function __construct() {}

    /**
     * Защищаем от создания через клонирование
     * @return TranslatorService
     */
    public function __clone() {}

    /**
     * Защищаем от создания через unserialize
     * @return TranslatorService
     */
    public function __wakeup() {}

    /**
     * Возвращает единственный экземпляр класса
     * @return TranslatorService
     */
    public static function getInstance(): TranslatorService {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function translate(string $inputValue): string
    {
        return strtr($inputValue, $this->letters);
    }


}