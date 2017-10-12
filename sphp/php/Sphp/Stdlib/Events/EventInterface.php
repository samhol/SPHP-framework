<?php

/**
 * EventInterface.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Stdlib\Events;

/**
 * Defines an event
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface EventInterface {

  /**
   * Return the name of the event
   *
   * @return string the name of the event
   */
  public function getName(): string;

  /**
   * Return the subject
   *
   * @return mixed subject
   */
  public function getSubject();

  /**
   * Sets the subject
   * 
   * @param  mixed $subject the subject
   * @return $this for a fluent interface
   */
  public function setSubject($subject);

  /**
   * Stops the event from being used anymore
   *
   * @return $this for a fluent interface
   */
  public function stopPropagation();

  /**
   * Checks if the event is stopped
   * 
   * @return boolean true if the event is stopped
   */
  public function isStopped(): bool;
}
