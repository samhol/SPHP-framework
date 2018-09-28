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
 * Event object that can also act as a container for any type of data.
 *
 * Implements an event. Objects can 'subscribe'
 * to these events and get notified when they trigger.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class DataEvent implements Event {

  /**
   * Event name
   *
   * @var string
   */
  private $name;

  /**
   * Subject (usually the one who created the event)
   *
   * @var mixed
   */
  private $subject;

  /**
   * Flags an event as stopped or not, default is false
   *
   * @var boolean
   */
  private $stopped = false;

  /**
   * Data to pass to listeners
   *
   * @var mixed
   */
  private $data;

  /**
   * Creates a new instance
   *
   * @param string $name the name of the event
   * @param mixed $subject subject the subject which dispatched this event
   * @param mixed $data the data dispatched with this event
   */
  public function __construct(string $name, $subject = null, $data = null) {
    $this->setName($name)
            ->setSubject($subject)
            ->setData($data);
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->name, $this->subject, $this->stopped, $this->data);
  }

  /**
   * Sets the name of the event
   * 
   * @param  string $name the name of the event
   * @return $this for a fluent interface
   */
  protected function setName(string $name) {
    $this->name = $name;
    return $this;
  }

  public function getName(): string {
    return $this->name;
  }

  public function setSubject($subject) {
    $this->subject = $subject;
    return $this;
  }

  public function getSubject() {
    return $this->subject;
  }

  public function stopPropagation() {
    $this->stopped = true;
  }

  public function isStopped(): bool {
    return $this->stopped;
  }

  /**
   * Sets the data attached to the event
   * 
   * @param  mixed $data the data attached to the event
   * @return $this for a fluent interface
   */
  public function setData($data) {
    $this->data = $data;
    return $this;
  }

  /**
   * Returns the data attached to the event
   *
   * @return mixed the data attached to the event
   */
  public function getData() {
    return $this->data;
  }

}
