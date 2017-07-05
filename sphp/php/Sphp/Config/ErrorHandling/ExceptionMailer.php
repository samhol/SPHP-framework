<?php

/**
 * ExceptionMailer.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Config\ErrorHandling;

use Sphp\Html\Foundation\Sites\Containers\ThrowableCallout;
use Throwable;

/**
 * Prints an exception as an HTML element
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ExceptionMailer implements ExceptionListener {

  /**
   * @var boolean 
   */
  private $showTrace = false;

  /**
   * @var boolean 
   */
  private $showPreviousException = false;

  public function onException(Throwable $e) {
    (new ThrowableCallout($e))
            ->showPreviousException($this->showPreviousException)
            ->showTrace($this->showTrace)
            ->printHtml();
  }

  /**
   * Sets the trace visibility
   * 
   * @param  boolean $show true for showing trace  
   * @return self for a fluent interface
   */
  public function showTrace($show = true) {
    $this->showTrace = $show;
    return $this;
  }

  /**
   * Sets the previous exception visibility
   * 
   * @param  boolean $show true for showing
   * @return self for a fluent interface
   */
  public function showPreviousException($show = true) {
    $this->showPreviousException = $show;
    return $this;
  }

}
