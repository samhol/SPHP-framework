<?php

/**
 * ErrorException.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Exceptions;

use ErrorException as PhpErrorException;

/**
 * SPHP-specific Error Exception
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-03-30
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ErrorException extends PhpErrorException implements Exception {
  
}
