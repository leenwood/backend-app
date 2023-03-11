<?php

namespace App\AdminBundle\Service\SpreedSheetService;

use App\AdminBundle\Service\DjangoBackendService\DTO\VacancySkillStat;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DownloadVacanciesStatsService
{


    /**
     * @param string $source
     * @param int $vacanciesFound
     * @param array $vacanciesStats
     * @param array $vacanciesNames
     *
     * @return Xlsx
     *
     * @throws Exception
     */
    public function get(string $source, int $vacanciesFound, array $vacanciesStats, array $vacanciesNames): Xlsx
    {
        return $this->createSpreadSheet($source, $vacanciesFound, $vacanciesStats, $vacanciesNames);
    }

    /**
     * @param string $source
     * @param int $vacanciesFound
     * @param array $vacanciesStats
     * @param array $vacanciesNames
     *
     * @return Xlsx
     *
     * @throws Exception
     */
    private function createSpreadSheet(string $source, int $vacanciesFound, array $vacanciesStats, array $vacanciesNames): Xlsx
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->mergeCells("A1:C1");
        // заголовки
        $sheet->setCellValue("A1", sprintf("Аналитика по сайту %s", $source));
        $sheet->setCellValue("A2", "Название навыка");
        $sheet->setCellValue("B2", "Общие количество навыка");
        $sheet->setCellValue("C2", "Частота использования");
        $sheet->setCellValue("E2", "Всего найдено вакансий");
        $sheet->setCellValue("F2", $vacanciesFound);
        $sheet->setCellValue("H2", "Названия вакансий");
        $sheet->setCellValue("I2", "(они идут в случайном порядке, отношения к списку навыков не имеют!)");

        foreach ($vacanciesStats as $key => $vacanciesStat) {
            $key = $key + 3;
            $sheet->setCellValue("A".$key, $vacanciesStat->getName());
            $sheet->setCellValue("B".$key, $vacanciesStat->getCount());
            $sheet->setCellValue("C".$key, $vacanciesStat->getRate());
        }

        foreach ($vacanciesNames as $key => $vacanciesName) {
            $key = $key + 3;
            $sheet->setCellValue("H".$key, $vacanciesName);
        }

        $writer = new Xlsx($spreadsheet);
        return $writer;
    }

}