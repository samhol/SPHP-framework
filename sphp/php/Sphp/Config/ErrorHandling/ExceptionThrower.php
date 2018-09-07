<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Config\ErrorHandling;

use Sphp\Exceptions\ErrorException;

/**
 * Converts PHP errors to exceptions
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ExceptionThrower implements ErrorHandler {

  /**
   * Throws the PHP error as a Exception
   * 
   * @param  int $errno the level of the error raised, as an integer
   * @param  string $errstr the error message
   * @param  string $errfile the filename where the exception is thrown
   * @param  int $errline the line number where the exception is thrown
   * @throws \Sphp\Exceptions\ErrorException
   */
  public function __invoke(int $errno, string $errstr, string $errfile, int $errline): bool {
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
  }

}
