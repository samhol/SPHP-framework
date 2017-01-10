<?php

/**
 * AbstractReader.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib\Reader;

use Exception;
use RuntimeException;

/**
 * Abstract reader implementation
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-11
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractReader implements ReaderInterface {

  public function fromFile($filename) {
    if (!is_file($filename) || !is_readable($filename)) {
      throw new RuntimeException(sprintf("File '%s' doesn't exist or is not readable", $filename));
    }
    return $this->fromString(file_get_contents($filename));
  }

}
