<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Config\ErrorHandling;

use ErrorException;
use Sphp\Exceptions\InvalidArgumentException;
use Exception;

/**
 * Implements an Error Exception thrower
 * 
 *  An instance of this class catches PHP errors and converts them to an exception 
 *  that can be caught at runtime.
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ErrorToExceptionThrower {

  /**
   * @var ErrorToExceptionThrower[]
   */
  public static $defaultInstance = [];

  /**
   * @var string
   */
  private $exceptionType;

  /**
   * Constructor
   * 
   * @param string $exceptionType
   */
  public function __construct(string $exceptionType = ErrorException::class) {
    $this->setExceptionType($exceptionType);
  }

  /**
   * Returns the exception type to throw
   * 
   * @return string the exception type to throw
   */
  public function getExceptionType(): string {
    return $this->exceptionType;
  }

  /**
   * Sets the exception type to throw
   * 
   * @param  string $exceptionType
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if the given exception type is invalid
   */
  public function setExceptionType(string $exceptionType) {
    if (!is_a($exceptionType, Exception::class, true)) {
      throw new InvalidArgumentException("'$exceptionType' is invalid exception type");
    }
    $this->exceptionType = $exceptionType;
    return $this;
  }

  /**
   * Starts redirecting PHP errors
   * 
   * @param  int $level PHP Error level to catch (Default = E_ALL & ~E_DEPRECATED)
   * @return $this for a fluent interface
   */
  public function start(int $level = \E_ALL) {
    set_error_handler($this, $level);
    //register_shutdown_function(array($this, 'fatalErrorShutdownHandler'));
    return $this;
  }

  /**
   * Stops redirecting PHP errors
   * 
   * @return $this for a fluent interface
   */
  public function stop() {
    restore_error_handler();
    return $this;
  }

  /**
   * Shutdown handler for fatal errors
   * 
   * @throws ErrorException
   */
  public function fatalErrorShutdownHandler() {
    $last_error = error_get_last();
    if ($last_error['type'] === \E_ERROR) {
      // fatal error
      $this(\E_ERROR, $last_error['message'], $last_error['file'], $last_error['line']);
    }
  }

  /**
   * Fired by the PHP error handler function
   * 
   * Calling this function will always throw an exception unless `error_reporting == 0`.
   * If the PHP command is called with @ preceeding it, then it will be ignored 
   * here as well.
   * 
   * @param int $severity the level of the error raised, as an integer
   * @param string $message the error message
   * @param string $file the filename where the exception is thrown
   * @param int $line the line number where the exception is thrown
   * @return bool false if error reportion is turnad of for the error severity class
   * @throws Exception
   */
  public function __invoke(int $severity, string $message, string $file, int $line): bool {
    if (!(error_reporting() & $severity)) {
      return false;
    }
    $type = $this->getExceptionType();
    if (is_a($type, ErrorException::class, true)) {
      //var_dump($type);
      $ex = new $type($message, 0, $severity, $file, $line);
    } else {
      $type = $this->getExceptionType();
      $ex = new $type($message, $severity);
    }
    throw $ex;
  }

  /**
   * Returns the singleton instance
   * 
   * @param  string $exceptionType
   * @return ErrorToExceptionThrower singleton instance
   */
  public static function getInstance(string $exceptionType = ErrorException::class): ErrorToExceptionThrower {
    if (!array_key_exists($exceptionType, self::$defaultInstance)) {
      self::$defaultInstance[$exceptionType] = new self($exceptionType);
    }
    return self::$defaultInstance[$exceptionType];
  }

}
