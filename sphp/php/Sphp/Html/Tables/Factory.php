<?php

/**
 * Factory.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Tables;

use Sphp\Stdlib\CsvFile;
use Sphp\Exceptions\RuntimeException;

/**
 * Description of Factory
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-04-04
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Factory {

  /**
   * 
   * @param  CsvFile $file
   * @param  int $offset optional offset of the limit
   * @param  int $count optional count of the limit
   * @return Table
   * @throws \Sphp\Exceptions\RuntimeException
   */
  public static function fromCsvFile(CsvFile $file, $offset = 0, $count = -1) {
    $table = new Table();
    if ($offset > 0 || $count !== -1) {
      $data = $file->getChunk($offset, $count);
    } else {
      $data = $file->toArray();
    }
    if ($offset > 0) {
      $table->thead()->appendHeaderRow($file->getHeaderRow());
    } else {
      $table->thead()->appendHeaderRow(array_shift($data));
    }
    foreach ($data as $row) {
      $table->tbody()->appendBodyRow($row);
    }
    return $table;
  }

}
