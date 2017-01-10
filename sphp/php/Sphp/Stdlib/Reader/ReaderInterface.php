<?php

/**
 * ReaderInterface.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib\Reader;

interface ReaderInterface {

  /**
   * Read from a file and create an array
   *
   * @param  string $filename
   * @return mixed
   * @throws RuntimeException if the file doesn't exist or is not readable
   */
  public function fromFile($filename);

  /**
   * Read from a string and create an array
   *
   * @param  string $string
   * @return mixed
   */
  public function fromString($string);
}
