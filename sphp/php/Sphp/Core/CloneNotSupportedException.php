<?php

/**
 * CloneNotSupportedException.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core;

use Exception;

/**
 * Exception class for non supported object cloning
 * 
 * Thrown to indicate that the magic `__clone` method in a class has been called
 * to clone an object, but that the object's class does not support cloning.
 *
 * Applications that override the `__clone` method can also throw this exception
 * to indicate that an object could not or should not be cloned.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-19
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 * @see     CloneNotSupportedTrait
 */
class CloneNotSupportedException extends Exception {
  
}
