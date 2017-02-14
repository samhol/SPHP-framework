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
 * @author Sami Holck
 */
class InvalidArgumentException extends SplInvalidArgumentException implements Exception {

}