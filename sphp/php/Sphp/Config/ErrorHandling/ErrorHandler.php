<?php

/**
 * ExceptionHandler.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Config\ErrorHandling;

use Sphp\Stdlib\Observers\Subject;

/**
 * Class sends uncaught exception messages to the proper handlers
 *
 * The ExceptionHandler class sends uncaught exception messages to the proper handlers.  This is done
 *  using the Observer pattern.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-05
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ErrorHandler implements Subject {

  use \Sphp\Stdlib\Observers\ObservableSubjectTrait;

  /**
   *
   * @var self[]
   */
  private static $handlers;

  /**
   * the level of the error raised,
   *
   * @var int
   */
  private $errno;

  /**
   * the error message
   *
   * @var string
   */
  private $errstr;

  /**
   * the filename that the error was raised in
   *
   * @var string
   */
  private $errfile;

  /**
   * the line number the error was raised at
   *
   * @var int
   */
  private $errline;

  /**
   * the line number the error was raised at
   *
   * @var boolean
   */
  private $chain = false;

  /**
   * Exception handling method
   *
   * @param int $errno
   * @link  http://php.net/manual/en/function.set-error-handler.php set_exception_handler()-method
   */
  public function __invoke($errno, $errstr, $errfile, $errline) {
    if (!(error_reporting() & $errno)) {
      // This error code is not included in error_reporting, so let it fall
      // through to the standard PHP error handler
      return false;
    }
    $this->errno = $errno;
    $this->errstr = $errstr;
    $this->errfile = $errfile;
    $this->errline = $errline;
    $this->notify();
    return true;
  }

  /**
   * Starts redirecting PHP errors
   * 
   * @param int $level PHP Error level to catch (Default = E_ALL & ~E_DEPRECATED)
   */
  public function start($level = \E_ALL) {
    set_error_handler($this, $level);
    $id = spl_object_hash($this);
    static::$handlers[$id] = $this;
    //register_shutdown_function(array(self::class, 'fatalErrorShutdownHandler'));
    return $this;
  }

  /**
   * Stops redirecting PHP errors
   */
  public function stop() {
    restore_error_handler();
  }
  public function chainHandlers($chainHandlers) {
    return $this->chain;
  }

  public function chainHandlers($chainHandlers) {
    $this->chain = $chain;
    return $this;
  }

    /**
   * Returns the level of the error raised
   * 
   * @return int the level of the error raised
   */
  public function getErrno() {
    return $this->errno;
  }

  /**
   * Returns the error message
   * 
   * @return string the error message
   */
  public function getErrstr() {
    return $this->errstr;
  }

  /**
   * Returns the filename that the error was raised in
   * 
   * @return string the filename that the error was raised in
   */
  public function getErrfile() {
    return $this->errfile;
  }

  /**
   * Returns the line number the error was raised at
   * 
   * @return int the line number the error was raised at
   */
  public function getErrline() {
    return $this->errline;
  }

}
