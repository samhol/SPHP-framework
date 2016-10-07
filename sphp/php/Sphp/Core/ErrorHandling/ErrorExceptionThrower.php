<?php

/*
 * ErrorExceptionThrower.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\ErrorHandling;

use ErrorException;

/**
 * Utility for catching PHP errors and converting them to an exception that can be caught at runtime
 * 
 * @author Jason Hinkle
 * 
 * @copyright  1997-2011 VerySimple, Inc.
 * @license    http://www.gnu.org/licenses/lgpl.html  LGPL
 */
class ErrorExceptionThrower {

  static $ignoreDeprecated = true;

  /**
   * Starts redirecting PHP errors
   * 
   * @param int $level PHP Error level to catch (Default = E_ALL & ~E_DEPRECATED)
   */
  public static function start($level = \E_ALL) {
    if ($level == null) {
      if (defined('E_DEPRECATED')) {
        $level = E_ALL & ~E_DEPRECATED;
      } else {
        // php 5.2 and earlier don't support E_DEPRECATED
        $level = E_ALL;
        self::$ignoreDeprecated = true;
      }
    }
    set_error_handler(array(self::class, 'handleError'), $level);
    register_shutdown_function(array(self::class, 'fatalErrorShutdownHandler'));
  }

  /**
   * Stops redirecting PHP errors
   */
  public static function stop() {
    restore_error_handler();
  }

  /**
   * Shutdown handler for fatal errors
   * 
   * @throws ErrorException
   */
  public static function fatalErrorShutdownHandler() {
    $last_error = error_get_last();
    if ($last_error['type'] === \E_ERROR) {
      // fatal error
      self::handleError(\E_ERROR, $last_error['message'], $last_error['file'], $last_error['line']);
    }
  }

  /**
   * Fired by the PHP error handler function
   * 
   * Calling this function will always throw an exception unless `error_reporting == 0`.
   * If the PHP command is called with @ preceeding it, then it will be ignored 
   * here as well.
   *
   * @param  string $code 
   * @param  string $string The Exception message to throw.
   * @param  string $file
   * @param  string $line
   * @return void
   * @throws ErrorException
   */
  public static function handleError($code, $string = '', $file = '', $line = '') {
    // ignore supressed errors
    if (error_reporting() == 0) {
      return;
    }
    throw new ErrorException($string, $code, 0, $file, $line);
  }

}
