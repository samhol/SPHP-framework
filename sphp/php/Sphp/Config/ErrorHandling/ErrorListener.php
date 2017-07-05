<?php

/**
 * ErrorListener.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Config\ErrorHandling;

/**
 * Defines an Error listener for Error dipatcher
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://php.net/manual/en/function.set-error-handler.php
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
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
   */
  public function onError(int $errno, string $errstr, string $errfile, int $errline);
}
