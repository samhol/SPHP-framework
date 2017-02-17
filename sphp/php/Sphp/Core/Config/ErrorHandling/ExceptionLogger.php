<?php

/**
 * ExceptionLogger.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Config\ErrorHandling;

use Sphp\Core\Observers\Observer;
use Sphp\Core\Observers\Subject;

/**
 * Logs uncaught exceptions to a file for debugging
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-05
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ExceptionLogger implements Observer {

  /**
   *
   * @var string 
   */
  private $destination;

  public function __construct($destination) {
    $this->setDestination($destination);
  }

  /**
   * 
   * @return string
   */
  public function getDestination() {
    return $this->destination;
  }

  /**
   * 
   * @param  string $destination
   * @return self for PHP Method Chaining
   */
  public function setDestination($destination) {
    $this->destination = $destination;
    return $this;
  }

  /**
   * Update the error_log with information about the uncaught Exception and echoes the exception in an ExceptionBox element
   *
   * @param  Subject $subject the ExceptionHandler
   * @see    ExceptionHandler
   */
  public function update(Subject $subject) {
    if ($subject instanceof ExceptionHandler) {
      error_log($subject->getException(), 3, $this->getDestination());
    }
  }

}
