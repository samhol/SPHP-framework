<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Exceptions;

use Sphp\Exceptions\RuntimeException;

/**
 * Indicates the current state of the object involved is invalid
 *
 * Indicates that an operation as been attempted at an inappropriate time. In 
 * other words, the system is not in an appropriate state for the requested operation.
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class InvalidStateException extends RuntimeException {
  
}
