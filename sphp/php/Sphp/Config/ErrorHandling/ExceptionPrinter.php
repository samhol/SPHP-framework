<?php

/**
 * ExceptionPrinter.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Config\ErrorHandling;

use Sphp\Html\Foundation\Sites\Containers\ThrowableCallout;
use Sphp\Stdlib\Observers\Observer;
use Sphp\Stdlib\Observers\Subject;

/**
 * Prints an exception as an HTML element
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-05
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ExceptionPrinter implements Observer {

  /**
   * @var boolean 
   */
  private $showTrace = false;

  /**
   * @var boolean 
   */
  private $showPreviousException = false;

  /**
   * Echoes the uncaught exception in an {@link ExceptionBox} html element
   *
   * @param  Subject $subject the ExceptionHandler
   * @uses   ExceptionHandler
   * @uses   ThrowableCallout
   */
  public function update(Subject $subject) {
    if ($subject instanceof ExceptionHandler) {
      (new ThrowableCallout($subject->getException()))
              ->showPreviousException($this->showPreviousException)
              ->showTrace($this->showTrace)
              ->printHtml();
    }
  }

  /**
   * Sets the trace visibility
   * 
   * @param  boolean $show true for showing trace  
   * @return self for a fluent interface
   */
  public function showTrace(bool $show = true) {
    $this->showTrace = $show;
    return $this;
  }

  /**
   * Sets the previous exception visibility
   * 
   * @param  boolean $show true for showing
   * @return self for a fluent interface
   */
  public function showPreviousException(bool $show = true) {
    $this->showPreviousException = $show;
    return $this;
  }

}
