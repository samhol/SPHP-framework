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
class ErrorHandler implements Subject {

  use \Sphp\Stdlib\Observers\ObservableSubjectTrait;

  /**
   * The uncaught Exception that needs to be handled
   *
   * @var Exception
   */
  private $errno;
  private $errstr;
  private $errfile;
  private $errline;

  /**
   * Exception handling method
   *
   * @param int $errno
   * @link  http://php.net/manual/en/function.set-error-handler.php set_exception_handler()-method
   */
  public function __invoke($errno, $errstr, $errfile, $errline) {
    $this->errno = $errno;
    $this->errstr = $errstr;
    $this->errfile = $errfile;
    $this->errline = $errline;
    $this->notify();
  }

  public function getErrno() {
    return $this->errno;
  }

  public function getErrstr() {
    return $this->errstr;
  }

  public function getErrfile() {
    return $this->errfile;
  }

  public function getErrline() {
    return $this->errline;
  }

}
