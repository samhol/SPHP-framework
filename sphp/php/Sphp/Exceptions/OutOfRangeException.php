<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Exceptions;

use OutOfRangeException as SplOutOfRangeException;

/**
 * Exception thrown when an illegal index was requested
 * 
 * This represents errors that should be detected at compile time.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class OutOfRangeException extends SplOutOfRangeException implements SphpExceptionInterface {
  
}
