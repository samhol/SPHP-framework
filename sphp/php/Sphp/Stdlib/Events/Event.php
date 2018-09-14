<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Events;

/**
 * Defines an event
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface Event {

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
