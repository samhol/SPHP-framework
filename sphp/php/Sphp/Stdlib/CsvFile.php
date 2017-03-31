<?php

/**
 * CsvFile.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib;

use Sphp\Stdlib\Datastructures\Arrayable;
use SplFileObject;

/**
 * CSV file object
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-09-11
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class CsvFile implements Arrayable {

  /**
   * 
   * @param string $filename
   * @param string $control
   */
  public function __construct($filename, $control = ',') {
    $this->file = new SplFileObject($filename, 'r');
    $this->file->setCsvControl($control);
  }

  /**
   * 
   * @param  array $data
   * @return self for a fluent interface
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
