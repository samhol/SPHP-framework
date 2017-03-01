<?php

/**
 * ExceptionHandler.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Config\ErrorHandling;

use Exception;
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
class ExceptionHandler implements Subject {

  use \Sphp\Stdlib\Observers\ObservableSubjectTrait;

  /**
   * The uncaught Exception that needs to be handled
   *
   * @var Exception
   */
  private $exception;

  /**
   * Exception handling method
   *
   * @param \Throwable|Exception $e handled exception
   * @link  http://php.net/manual/en/function.set-exception-handler.php set_exception_handler()-method
   */
  public function __invoke($e) {
    $this->exception = $e;
    $this->notify();
  }

  /**
   * Exception handling method
   *
   * @param \Throwable|Exception $e handled exception
   * @link  http://php.net/manual/en/function.set-exception-handler.php set_exception_handler()-method
   */
  public function handle($e) {
    $this->exception = $e;
    $this->notify();
  }

  /**
   * Rerurns the uncaught Exception that needs to be handled
   *
   * @return \Throwable|Exception the uncaught Exception
   */
  public function getException() {
    return $this->exception;
  }

}
