<?php

/**
 * Factory.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Tables;

use Sphp\Stdlib\Filesystem;
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
   * @param  string $path
   * @param  string $delimeter 
   * @return Table
   * @throws \Sphp\Exceptions\RuntimeException
   */
  public static function fromCsvFile($path, $delimeter = ',', $first = 0, $last = null) {
    if (!Filesystem::isFile($path)) {
      throw new RuntimeException("The path '$path' does not exist");
    }
    $data = (new CsvFile($path, $delimeter))->getChunk($first, $last);
    $table = new Table();
    $table->thead()->appendHeaderRow(array_shift($data));
    foreach ($data as $row) {
      $table->tbody()->appendBodyRow($row);
    }
    return $table;
  }

}
