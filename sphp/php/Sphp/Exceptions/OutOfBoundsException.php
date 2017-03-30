<?php

/**
 * OutOfBoundsException.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Exceptions;

use OutOfBoundsException as SplOutOfBoundsException;

/**
 * SPHP-specific out of bounds exception
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-03-30
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class OutOfBoundsException extends SplOutOfBoundsException implements Exception {
  
}
