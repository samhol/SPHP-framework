<?php

/**
 * ExceptionLogger.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\ErrorHandling;

/**
 * Class is responsible for logging uncaught exceptions to a file for debugging
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-05
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ExceptionLogger implements \SplObserver {

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
   * @param type $destination
   * @return \Sphp\Core\ErrorHandling\ExceptionLogger
   */
  public function setDestination($destination) {
    $this->destination = $destination;
    if (!is_file($destination)) {
      $myfile = fopen($destination, "w");
    }
    return $this;
  }

  /**
   * Update the error_log with information about the uncaught Exception and echoes the exception in an ExceptionBox element
   *
   * @param  \SplSubject $subject the ExceptionHandler
   * @see    ExceptionHandler
   */
  public function update(\SplSubject $subject) {
    if ($subject instanceof ExceptionHandler) {
      error_log($subject->getException(), 3, $this->getDestination());
    }
  }

}
