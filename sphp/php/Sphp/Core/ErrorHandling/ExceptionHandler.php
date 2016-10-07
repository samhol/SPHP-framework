<?php

/**
 * ExceptionHandler.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\ErrorHandling;

use \SplSubject as SplSubject;
use \Exception as Exception;
use Sphp\Core\ObservableSubjectTrait as ObservableSubjectTrait;

/**
 * Class sends uncaught exception messages to the proper handlers
 *
 * The ExceptionHandler class sends uncaught exception messages to the proper handlers.  This is done
 *  using the Observer pattern, and SplObserver/SplSubject.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-05
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ExceptionHandler implements SplSubject {

  use ObservableSubjectTrait;

  /**
   * The uncaught Exception that needs to be handled
   *
   * @var Exception
   */
  private $exception;

  /**
   * Exception handling method
   *
   * @param Exception $e handled exception
   * @link  http://php.net/manual/en/function.set-exception-handler.php set_exception_handler()-method
   */
  public function handle(Exception $e) {
    $this->exception = $e;
    $this->notify();
  }

  /**
   * Rerurns the uncaught Exception that needs to be handled
   *
   * @return Exception the uncaught Exception
   */
  public function getException() {
    return $this->exception;
  }

}
