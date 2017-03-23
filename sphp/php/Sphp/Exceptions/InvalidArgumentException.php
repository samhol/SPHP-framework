<?php

/**
 * InvalidArgumentException.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Exceptions;

use InvalidArgumentException as SplInvalidArgumentException;

/**
 * SPHP-specific invalid argument exception
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-02-09
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class InvalidArgumentException extends SplInvalidArgumentException implements Exception {

}
