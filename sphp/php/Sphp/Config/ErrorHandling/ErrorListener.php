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
 * Defines an Error listener for Error dispatcher
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://php.net/manual/en/function.set-error-handler.php
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface ErrorListener {

  /**
   * PHP Error handling method
   * 
   * @param  int $errno the level of the error raised
   * @param  string $errstr the error message
   * @param  string $errfile the filename that the error was raised in
   * @param  int $errline the line number the error was raised at
   * @return void
   */
  public function onError(int $errno, string $errstr, string $errfile, int $errline): void;
}
