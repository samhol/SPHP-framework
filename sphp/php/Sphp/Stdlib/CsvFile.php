<?php

/**
 * CsvFile.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib;

use Sphp\Stdlib\Datastructures\Arrayable;
use SplFileObject;

/**
 * Description of CsvFile
 *
 * @author Sami
 */
class CsvFile implements Arrayable {

  public function __construct($filename) {
    $this->file = new SplFileObject($filename,'r');
    $this->file->setCsvControl(',');
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
    while (!$this->file->eof() && ($row = $this->file->fgetcsv()) && $row[0] !== null) {
      $arr[] = $row;
    }
    return $arr;
  }

}
