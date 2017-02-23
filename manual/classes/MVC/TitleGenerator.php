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
 * @since   2014-09-11
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class TitleGenerator {

  public function __construct(array $data) {
    $this->data = $data;
    $this->titleData = $this->parseTitles();
    $this->parseTitles();
  }

  public function parseTitles() {
    // print_r($this->data);
    $arrIt = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($this->data));
    $f = function () {
      
    };
    $outputArray = [];
    foreach ($arrIt as $sub) {
      $subArray = $arrIt->getSubIterator();
      if ($subArray->key() === 'page') {
        $outputArray[] = iterator_to_array($subArray);
      }
    }

    // print_r($outputArray);
    return $outputArray;
  }

  public function createTitleFor($page) {
    $title = 'SPHP Framework';
    foreach ($this->titleData as $pair) {
      if ($pair['page'] === $page) {
        $title .= ': ' . $pair['link'];
        break;
      }
    }
    return $title;
  }

}
