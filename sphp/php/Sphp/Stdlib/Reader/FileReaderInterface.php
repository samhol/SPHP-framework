<?php

/**
 * FileReaderInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib\Reader;

use Sphp\Exceptions\RuntimeException;

/**
 * Defines a file reader
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-01-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface FileReaderInterface {

  /**
   * Read from a file and create an array
   *
   * @param  string $filename
   * @return mixed
   * @throws RuntimeException if the file doesn't exist or is not readable
   */
  public function fromFile($filename);
}
