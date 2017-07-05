<?php

/*
 * ErrorExceptionThrower.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Config\ErrorHandling;

use Sphp\Exceptions\ErrorException;

/**
 * Converts PHP errors to exceptions
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ExceptionThrower implements ErrorHandlerInterface {

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
