<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Config\ErrorHandling;

/**
 * Class sends uncaught exception messages to the proper handlers
 *
 * This class send PHP errors and warnings to its observers.  This is done
 * using the Observer pattern.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface ErrorHandler {

  /**
   * Error handling method
   *
   * @param  int $errno
   * @param  string $errstr
   * @param  string $errfile
   * @param  int $errline
   * @return boolean
   * @link   https://secure.php.net/manual/en/function.set-error-handler.php set_exception_handler()-method
   */
  public function __invoke(int $errno, string $errstr, string $errfile, int $errline): bool;
}
