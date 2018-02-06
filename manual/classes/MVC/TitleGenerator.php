<?php

/**
 * TitleGenerator.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Manual\MVC;

/**
 * Generates a page title for the given page
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class TitleGenerator {

  public function __construct(array $data) {
    $this->data = $data;
    $this->titleData = $this->parseTitles();
    $this->parseTitles();
  }

  public function parseTitles(): array {
    // print_r($this->data);
    $arrIt = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($this->data));

    $outputArray = [];
    foreach ($arrIt as $sub) {
      $subArray = $arrIt->getSubIterator();
      if ($subArray->key() === 'href') {
        $outputArray[] = iterator_to_array($subArray);
      }
    }
    // print_r($outputArray);
    return $outputArray;
  }

  public function createTitleFor(string $page): string {
    if ($page === '') {
      $title = 'Introduction | SPHPlayground';
    } else {
    $title = 'SPHPlayground';
    foreach ($this->titleData as $pair) {
      if ($pair['href'] === $page) {
        if (isset($pair['title'])) {
          $title = $pair['title'] . ' | ' . $title;
        } else {
          $title = $pair['link'] . ' | ' . $title;
        }
        break;
      }
    }
    }
    return $title;
  }

}
