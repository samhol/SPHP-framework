<?php

/**
 * ConfigurationException.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core;

use Exception;

/**
 * Class implements 
 * 
 * Thrown to indicate that the magic `__clone` method in a class has been called
 * to clone an object, but that the object's class does not implement the {@see
 * CloneableInterface}.
 *
 * Applications that override the `__clone` method can also throw this exception
 * to indicate that an object could not or should not be cloned.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-19
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ConfigurationException extends Exception {
  
}
