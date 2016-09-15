<?php

/**
 * IdentifyingAttribute.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

use Sphp\Core\Types\Strings as Strings;

/**
 * An implementation of a HTML attribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-09-28

 * @link    http://www.w3schools.com/tags/att_global_id.asp id attribute
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class IdentifyingAttribute extends AbstractAttribute implements IdentifyingAttributeInterface {

  /**
   * collection of individual id change observer objects
   *
   * @var \SplObjectStorage
   */
  protected $observers;
  /**
   * the value of the id attribute
   *
   * @var scalar 
   */
  private $id = false;

  /**
   *
   * @var boolean
   */
  private $isLocked;

  /**
   * Identifies HtmlElement with an unique id attribute.
   *
   * **Notes:**
   *
   * HTML id attribute is unique to every HTML-element. Therefore given id is checked for its uniqueness.
   *
   * @param  string $seed id attributes seed
   * @param  boolean $locked
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_global_id.asp id attribute
   */
  public function identify($seed = "id_", $locked = false) {
    $value = $seed . Strings::generateRandomString();
    if ($locked) {
      $this->lock($value);
    } else {
      $this->set($value);
    }
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function clear() {
    if (!$this->isLocked() && !$this->isDemanded()) {
      $this->id = false;
    }
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function contains($value) {
    return $this->id == $value;
  }

  /**
   * {@inheritdoc}
   */
  public function getValue() {
    return $this->id;
  }

  /**
   * {@inheritdoc}
   */
  public function isLocked() {
    return $this->isLocked;
  }

  /**
   * {@inheritdoc}
   */
  public function lock($value) {
    $this->set($value);
    $this->isLocked;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function set($value) {
    if (!$this->isLocked() && $this->id != $value) {
      $this->id = $value;
      $this->notifyIdentityChange();
    }
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function attachIdentityObserver($observer) {
    $this->observers->attach($observer);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function detachIdentityObserver($observer) {
    $this->observers->detach($observer);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function notifyIdentityChange() {
    foreach ($this->observers as $obs) {
      if ($obs instanceof IdentityObserver) {
        $obs->identityChanged($this, $this->getName());
      } else {
        $obs($this, $this->getName());
      }
    }
    return $this;
  }

}
