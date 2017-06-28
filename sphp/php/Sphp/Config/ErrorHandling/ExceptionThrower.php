<?php

/*
 * ErrorExceptionThrower.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Config\ErrorHandling;

use ErrorException;

/**
 * Converts PHP errors to exceptions
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-06-26
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ExceptionThrower implements ErrorHandlerInterface {

  /**
   * @var string
   */
  private $type;

  public function __construct(string $exceptionType = ErrorException::class) {
    $this->setExceptionType($exceptionType);
  }

  /**
   * 
   * @return string
   */
  public function getExceptionType(): string {
    return $this->type;
  }

  /**
   * 
   * @param string $exceptionType
   * @return $this
   */
  public function setExceptionType(string $exceptionType) {
    if (!$exceptionType instanceof \Exception) {
      throw new InvalidArgumentException('Exception type must extend PHP\'s Exception');
    }
    $this->type = $exceptionType;
    return $this;
  }

  /**
   * 
   * 
   * @param int $errno
   * @param string $errstr
   * @param string $errfile
   * @param int $errline
   * @throws ErrorException
   */
  public function __invoke(int $errno, string $errstr, string $errfile, int $errline): bool {
    if ($this->getExceptionType()) {
      
    }
    $ex = new ErrorException($errstr, 0, $errno, $errfile, $errline);
  }

}
