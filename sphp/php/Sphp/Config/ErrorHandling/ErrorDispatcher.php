<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Config\ErrorHandling;

use Throwable;
use Sphp\Stdlib\Datastructures\PriorityQueue;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Class sends uncaught exception messages to the proper handlers
 *
 * This class send PHP errors and warnings to its observers.  This is done
 * using the Observer pattern.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ErrorDispatcher {

  /**
   * @var boolean
   */
  private $handlesExceptions = false;

  /**
   * @var PriorityQueue
   */
  private $errorListeners;

  /**
   * @var PriorityQueue
   */
  private $exceptionListeners;

  /**
   * Constructor
   */
  public function __construct() {
    $this->errorListeners = new PriorityQueue();
    $this->exceptionListeners = new PriorityQueue();
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->errorListeners, $this->exceptionListeners);
  }

  /**
   * Starts redirecting PHP errors
   * 
   * @return $this for a fluent interface
   */
  public function startErrorHandling() {
    $prev = set_error_handler([$this, 'triggerError'], \E_ALL);
    if (is_array($prev) && array_shift($prev) === $this) {
      restore_exception_handler();
    }
    
    return $this;
  }

  /**
   * Starts Exception Handling
   * 
   * @return $this for a fluent interface
   */
  public function startExceptionHandling() {
    $prev = set_exception_handler([$this, 'triggerException']);
    if (is_array($prev) && array_shift($prev) === $this) {
      restore_exception_handler();
    }
    $this->handlesExceptions = true;
    return $this;
  }

  /**
   * Stops redirecting PHP errors
   * 
   * @return $this for a fluent interface
   */
  public function stopErrorHandling() {
    restore_error_handler();
    return $this;
  }

  /**
   * Restores the previously defined exception handler function
   *
   * @return $this for a fluent interface
   * @link   http://php.net/manual/en/function.restore-exception-handler.php PHP manual
   */
  public function stopExceptionHandling() {
    if ($this->handlesExceptions) {
      restore_exception_handler();
      $this->handlesExceptions = false;
    }
    return $this;
  }

  /**
   * 
   * @param  int $errorLevel
   * @param  callable|ErrorListener $listener
   * @param  int $priority
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if the listener is of invalid type
   */
  public function addErrorListener(int $errorLevel, $listener, int $priority = 0) {
    if (!is_callable($listener) && !$listener instanceof ErrorListener) {
      throw new InvalidArgumentException('Error Listener must be a PHP callable or of type ' . ErrorListener::class);
    }
    $this->errorListeners->enqueue(['listener' => $listener, 'level' => $errorLevel], $priority);
    return $this;
  }

  /**
   * 
   * @param  callable|ExceptionListener $listener
   * @param  int $priority
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if the listener is of invalid type
   */
  public function addExceptionListener($listener, int $priority = 0) {
    if (!is_callable($listener) && !$listener instanceof ExceptionListener) {
      throw new InvalidArgumentException('Exception Listener must be a PHP callable or of type ' . ExceptionListener::class);
    }
    $this->exceptionListeners->enqueue($listener, $priority);
    return $this;
  }

  /**
   * PHP Error handling method
   * 
   * Propagates PHP errors to its listeners
   *
   * @param  int $errno the level of the error raised
   * @param  string $errstr the error message
   * @param  string $errfile the filename that the error was raised in
   * @param  int $errline the line number the error was raised at
   * @return boolean
   * @link   http://php.net/manual/en/function.set-error-handler.php set_exception_handler()-method
   */
  public function triggerError(int $errno, string $errstr, string $errfile, int $errline): bool {
    if (!(error_reporting() & $errno)) {
      return false;
    }
    foreach ($this->errorListeners->toArray() as $data) {
      $error = $data['level'];
      $l = $data['listener'];
      if ($errno & $error) {
        if ($l instanceof ErrorListener) {
          $l->onError($errno, $errstr, $errfile, $errline);
        } else {
          $l($errno, $errstr, $errfile, $errline);
        }
      }
    }
    return true;
  }

  /**
   * Propagates PHP error to its listeners
   * 
   * @param  Throwable
   * @return $this for a fluent interface
   */
  public function triggerException(Throwable $t) {
    foreach ($this->exceptionListeners->toArray() as $l) {
      if ($l instanceof ExceptionListener) {
        $l->onException($t);
      } else {
        $l($t);
      }
    }
    return $this;
  }

}
