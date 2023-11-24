<?php

namespace Chuva\Php\WebScrapping;

libxml_use_internal_errors(true);
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;

require 'Scrapper.php';
require_once 'vendor/autoload.php';
/**
 * Runner for the Webscrapping exercice.
 */
class Main
{
    /**
     * Main runner, instantiates a Scrapper and runs.
     */
    public static function run(): void
    {
        $dom = new \DOMDocument('1.0', 'utf-8');
        $dom->loadHTMLFile(__DIR__ . '/../../assets/origin.html');

        $data = (new Scrapper())->scrap($dom);

        $xlsxFile = __DIR__ . '/chuvaphp.xlsx';

        $excelDoc = WriterEntityFactory::createXLSXWriter();
        $excelDoc->openToFile($xlsxFile);

        // Criação do Header com as informações
        $headers = ['ID', 'Title', 'Type'];
        for ($i = 1; $i <= 20; ++$i) {
            $headers[] = "Author $i";
            $headers[] = "Author $i Institution";
        }

        $headerRow = WriterEntityFactory::createRowFromArray($headers);
        $excelDoc->addRow($headerRow);

        foreach ($data as $paper) {
            $rowData = [
                $paper->id,
                $paper->title,
                $paper->type,
            ];

            // Verificação de autores
            $authors = $paper->authors;


            for ($i = 0; $i < 20; ++$i) {
                if (isset($authors[$i])) {
                    $author = $authors[$i];
                    $rowData[] = $author->name;
                    $rowData[] = $author->institution;
                } else {
                    // Preencher com vazio quando não houver autores
                    $rowData[] = '';
                    $rowData[] = '';
                }
            }

            $row = WriterEntityFactory::createRowFromArray($rowData);
            $excelDoc->addRow($row);
        }

        $excelDoc->close();
    }
}
