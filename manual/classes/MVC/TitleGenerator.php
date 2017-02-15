<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Manual\MVC;

/**
 * Description of TitleGenerator
 *
 * @author Sami Holck
 */
class TitleGenerator {

  public function __construct(array $data, $currentPage = '') {
    $this->data = $data;
    $this->currentPage = $currentPage;
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
