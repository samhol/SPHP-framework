<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Stdlib;

use Sphp\Data\Arrayable;
use SplFileObject;

/**
 * Description of CsvFile
 *
 * @author Sami
 */
class CsvFile implements Arrayable {

  public function __construct($filename) {
    $this->file = new SplFileObject($filename);
    $this->file->setCsvControl(';');
  }

  /**
   * 
   * @param  array $data
   * @return $this
   */
  public function appendRow(array $data) {
    if ($data instanceof \Traversable) {
      $data = iterator_to_array($data);
    }
    $this->file->fputcsv($data);
    return $this;
  }

  public function toArray() {
    $arr = [];
    $this->file->setFlags(SplFileObject::DROP_NEW_LINE);
    while (!$this->file->eof()) {
      $arr[] = $this->file->fgetcsv();
    }
    return $arr;
  }

}
