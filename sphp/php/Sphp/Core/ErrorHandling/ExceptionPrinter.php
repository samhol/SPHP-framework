<?php

/**
 * ExceptionPrinter.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\ErrorHandling;

use \SplObserver as SplObserver;
use \SplSubject as SplSubject;
use Sphp\Html\Foundation\Sites\Containers\ExceptionCallout as ExceptionCallout;

/**
 * The Logger class is responsible for printing the uncaught exceptions as an HTML element
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-05
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ExceptionPrinter implements SplObserver {

  /**
   *
   * @var boolean 
   */
  private $showTrace = false;

  /**
   *
   * @var boolean 
   */
  private $showPreviousException = false;

  /**
   * Echoes the uncaught exception in an {@link ExceptionBox} html element
   *
   * @param  SplSubject $subject the ExceptionHandler
   * @uses   ExceptionHandler
   * @uses   ExceptionBox
   */
  public function update(SplSubject $subject) {
    if ($subject instanceof ExceptionHandler) {
      (new ExceptionCallout($subject->getException()))
              ->showPreviousException($this->showPreviousException)
              ->showTrace($this->showTrace)
              ->printHtml();
    }
  }

  /**
   * Sets the trace visibility
   * 
   * @param  boolean $show true for showing trace  
   * @return self for PHP Method Chaining
   */
  public function showTrace($show = true) {
    $this->showTrace = $show;
    return $this;
  }

  /**
   * Sets the previous exception visibility
   * 
   * @param  boolean $show true for showing
   * @return self for PHP Method Chaining
   */
  public function showPreviousException($show = true) {
    $this->showPreviousException = $show;
    return $this;
  }

}
