<?php

/**
 * StringReaderInterface.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib\Reader;

interface StringReaderInterface {

  /**
   * Read from a string and create an array
   *
   * @param  string $string
   * @return mixed
   */
  public function fromString($string);
}
