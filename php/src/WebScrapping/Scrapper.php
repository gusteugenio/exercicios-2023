<?php

namespace Chuva\Php\WebScrapping;

use Chuva\Php\WebScrapping\Entity\Paper;
use Chuva\Php\WebScrapping\Entity\Person;

/**
 * Does the scrapping of a webpage.
 */
class Scrapper {

  /**
   * Loads paper information from the HTML and returns the array with the data.
   */
  public function scrap(\DOMDocument $dom): array {
    return [
      $papers = [];
      
      // Obter todos os elementos que dizem respeito ao título do trabalho
      $paperTitle = $dom->getElementsByTagName('h4');
      $titles = [];
  
        foreach ($paperTitle as $h4) {
          // Verificar classes com 'my-xs paper-title' e atribuir à lista titles
            if ($h4->getAttribute('class') == 'my-xs paper-title') {
                $titles[] = $h4->textContent;
            }
        }

      // Obter todos os elementoss que dizem respeito ao tipo do trabalho
      $paperType = $dom->getElementsByTagName('div');
      $types = [];

      foreach ($paperType as $div) {
        // Verificar classes com 'tags mr-sm' e atribuir à lista types
          if ($div->getAttribute('class') === 'tags mr-sm') {
              $types[] = $div->textContent;
          }
      }
    ];
  }

}