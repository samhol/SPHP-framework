<?php

/**
 * ExceptionLogger.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Config\ErrorHandling;

use Throwable;
use Sphp\Stdlib\Filesystem;

/**
 * Logs uncaught exceptions to a file for debugging
 * 
 * 
 * Updates the error_log with information about the uncaught Exception and echoes 
 * the exception in an ExceptionBox element
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ExceptionLogger implements ExceptionListener {

  /**
   * @var string 
   */
  private $destination;

  public function __construct(string $destination) {
    $this->setDestination($destination);
  }

  /**
   * 
   * @return string
   */
  public function getDestination(): string {
    return $this->destination;
  }

  /**
   * 
   * @param  string $destination
   * @return self for a fluent interface
   */
  public function setDestination(string $destination) {
    if (!is_writable($destination)) {
      Filesystem::mkFile($destination);
    }
    $this->destination = $destination;
    return $this;
  }

  public function onException(Throwable $e) {
    error_log($e->getException(), 3, $e->getDestination());
  }

}
