<?php

/**
 * ErrorHandler.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Config\ErrorHandling;

/**
 * Class sends uncaught exception messages to the proper handlers
 *
 * This class send PHP errors and warnings to its observers.  This is done
 * using the Observer pattern.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ErrorHandlerInterface {

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
