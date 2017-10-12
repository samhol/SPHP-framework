<?php

/**
 * StringReaderInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib\Reader;

/**
 * Defines a string reader
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface StringReaderInterface {

  /**
   * Read from a string and create an array
   *
   * @param  string $string
   * @return mixed 
   */
  public function fromString(string $string);
}
