<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Stdlib;

/**
 * Description of CsvFile
 *
 * @author Sami
 */
class CsvFile {

  public function __construct($filename) {
    $this->file = new \SplFileObject($filename, 'a');
  }

  /**
   * 
   * @param type $data
   * @return $this
   */
  public function appendRow($data) {
    if ($data instanceof \Traversable) {
      $data = iterator_to_array($data);
    }
    $this->file->fputcsv($data);
    return $this;
  }

}
