<?php

/**
 * ExceptionHandler.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Config\ErrorHandling;

use Throwable;
use Sphp\Stdlib\Observers\Subject;

/**
 * Class sends uncaught exception messages to the proper handlers
 *
 * The ExceptionHandler class sends uncaught exception messages to the proper handlers.  This is done
 *  using the Observer pattern.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ExceptionHandler implements Subject {

  use \Sphp\Stdlib\Observers\ObservableSubjectTrait;

  /**
   * The uncaught Throwable that needs to be handled
   *
   * @var Throwable
   */
  private $throwable;

  /**
   *
   * @var self|null 
   */
  private static $currentHandler;

  /**
   * Exception handling method
   *
   * @param Throwable $e handled exception
   * @link  http://php.net/manual/en/function.set-exception-handler.php set_exception_handler()-method
   */
  public function __invoke(Throwable $e) {
    $this->throwable = $e;
    $this->notify();
  }

  /**
   * Exception handling method
   *
   * @param Throwable $e handled exception
   * @link  http://php.net/manual/en/function.set-exception-handler.php set_exception_handler()-method
   */
  /* public function handle($e) {
    $this->exception = $e;
    $this->notify();
    } */

  /**
   * Sets this as the user-defined exception handler
   *
   * @return self for a fluent interface
   * @link   http://php.net/manual/en/function.set-exception-handler.php PHP manual
   */
  public function start() {
    set_exception_handler($this);
    static::$currentHandler = $this;
    return $this;
  }

  /**
   * Restores the previously defined exception handler function
   *
   * @return self for a fluent interface
   * @link   http://php.net/manual/en/function.restore-exception-handler.php PHP manual
   */
  public function stop() {
    if (static::$currentHandler === $this) {
      restore_exception_handler();
      static::$currentHandler = null;
    }
    return $this;
  }

  /**
   * Returns the uncaught Exception that needs to be handled
   *
   * @return Throwable the uncaught Exception
   */
  public function getException() {
    return $this->throwable;
  }

}
