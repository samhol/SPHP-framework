<?php

/**
 * OutOfRangeException.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Exceptions;

use OutOfRangeException as SplOutOfRangeException;

/**
 * Exception thrown when an illegal index was requested
 * 
 * This represents errors that should be detected at compile time.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-04-24
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class OutOfRangeException extends SplOutOfRangeException implements Exception {
  
}
