<?php

/**
 * RuntimeException.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Exceptions;

use RuntimeException as SplRuntimeException;


/**
 * Exception thrown if an error which can only be found on runtime occurs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-02-09
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class RuntimeException extends SplRuntimeException implements Exception {

}
