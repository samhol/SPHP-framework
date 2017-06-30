<?php

/**
 * ErrorHandler.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Config\ErrorHandling;

use SplObjectStorage;

/**
 * Class sends uncaught exception messages to the proper handlers
 *
 * This class send PHP errors and warnings to its observers.  This is done
 * using the Observer pattern.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-05
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ErrorDispatcher {

  /**
   * The event listeners as event name => PrioritizedObjectStorage pairs
   *
   * @var SplObjectStorage
   */
  private $listeners;

  public function __construct() {
    $this->listeners = new SplObjectStorage();
  }

  /**
   * Exception handling method
   *
   * @param  int $errno
   * @param  string $errstr
   * @param  string $errfile
   * @param  int $errline
   * @return boolean
   * @link   http://php.net/manual/en/function.set-error-handler.php set_exception_handler()-method
   */
  public function __invoke(int $errno, string $errstr, string $errfile, int $errline) {
    if (!(error_reporting() & $errno)) {
      return false;
    }
    $this->triggerEvent($errno, $errstr, $errfile, $errline);
    return true;
  }

  /**
   * Starts redirecting PHP errors
   * 
   * @param  int $level PHP Error level to catch
   * @return self for a fluent interface
   */
  public function start(int $level = \E_ALL) {
    set_error_handler($this, $level);
    return $this;
  }

  /**
   * Stops redirecting PHP errors
   * 
   * @return self for a fluent interface
   */
  public function stop() {
    restore_error_handler();
    return $this;
  }

  /**
   * Destroys the instance
   * 
   * The destructor method will be called as soon as there are no other references 
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->listeners);
  }

  /**
   * 
   * @param  int $errorLevel
   * @param  callable $listener
   * @return self for a fluent interface
   */
  public function addListener(int $errorLevel, callable $listener) {
    //echo "attach listener for error $event";
    $this->listeners->attach($listener, $errorLevel);
    return $this;
  }

  public function remove(callable $listener) {
    $this->listeners->detach($listener);
    return $this;
  }
  
  /**
   * 
   * @param int $errno
   * @param string $errstr
   * @param string $errfile
   * @param int $errline
   * @return self for a fluent interface
   */
  public function triggerEvent(int $errno, string $errstr, string $errfile, int $errline) {
    $event = new ErrorEvent($errno, $errstr, $errfile, $errline);
    $this->trigger($event);
    return $this;
  }

  /**
   * 
   * @param  ErrorEvent $event
   * @return self for a fluent interface
   */
  public function trigger(ErrorEvent $event) {
    $eventError = $event->getErrno();
    foreach ($this->listeners as $key) {
      $error = $this->listeners[$key];
      if ($eventError & $error) {
        $key($event);
      }
    }
    return $this;
  }

}
