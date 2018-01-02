<?php

/**
 * InvalidStateException.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Exceptions;

use Exception;
use Sphp\Exceptions\SphpException;

/**
 * Indicates the current state of an object involved in the method invocation 
 * does not meet the acceptable pre-conditions for the method. Each method which 
 * changes the call model typically has a set of states in which the object must 
 * be as a pre-condition for the method. Each method documents the pre-condition 
 * states for objects. Typically, this method will succeed in the future once 
 * the object in question has reached the proper state.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class InvalidStateException extends Exception implements SphpException {
  
}
