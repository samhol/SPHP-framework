<?php

/**
 * FileReaderInterface.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib\Reader;

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
