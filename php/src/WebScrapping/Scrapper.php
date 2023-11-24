<?php

namespace Chuva\Php\WebScrapping;

require __DIR__ . '/Entity/Paper.php';
use Chuva\Php\WebScrapping\Entity\Paper;
use Chuva\Php\WebScrapping\Entity\Person;

/**
 * Does the scrapping of a webpage.
 */
class Scrapper
{
    /**
     * Loads paper information from the HTML and returns the array with the data.
     */
    public function scrap(\DOMDocument $dom): array
    {
        $papers = [];

        // Obter todos os elementos que dizem respeito ao título do trabalho
        $titles = $this->getElementsTextByClass($dom, 'h4', 'my-xs paper-title');

        // Obter todos os elementoss que dizem respeito ao tipo do trabalho
        $types = $this->getElementsTextByClass($dom, 'div', 'tags mr-sm');

        // Obter todos os elementos que dizem respeito ao id do trabalho
        $ids = $this->getElementsTextByClass($dom, 'div', 'volume-info');

        // Obter todos os elementoss que dizem respeito aos autores do trabalho
        $authorElements = $dom->getElementsByTagName('div');
        $authors = [];

        foreach ($authorElements as $author) {
            // Verificar classes com 'authors'
            if ($author->getAttribute('class') === 'authors') {
                $span = $author->getElementsByTagName('span');
                $authorInfo = [];

                // Atribuir dados do autor (Nome e Instituição) a authorInfo, através de new Person
                foreach ($span as $span) {
                    $authorName = strtr($span->textContent, [';' => '']);
                    $institutionName = $span->getAttribute('title');
                    $authorData = new Person($authorName, $institutionName);
                    $authorInfo[] = $authorData;
                }

                $authors[] = $authorInfo;
            }
        }

        // Criar o objeto Paper para comportar todas informações
        foreach ($ids as $index => $id) {
            $papers[] = new Paper($id, $titles[$index], $types[$index], $authors[$index]);
        }

        return $papers;
    }

    /**
     * Obtém os textos dos elementos com uma classe específica.
     *
     * @param \DOMDocument $dom
     * @param string $tagName
     * @param string $class
     * @return array
     */
    private function getElementsTextByClass(\DOMDocument $dom, string $tagName, string $class): array
    {
        $elements = $dom->getElementsByTagName($tagName);
        $texts = [];

        foreach ($elements as $element) {
            if ($element->getAttribute('class') === $class) {
                $texts[] = $element->textContent;
            }
        }

        return $texts;
    }
}
