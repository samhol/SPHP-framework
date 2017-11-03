<?php

/**
 * BooleanAttribute.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

use Sphp\Html\Attributes\Exceptions\InvalidAttributeException;

/**
 * Implements a boolean attribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-10-24
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class BooleanAttribute extends AbstractAttribute {

  /**
   * @var mixed 
   */
  private $value = false;

  /**
   * @var bool 
   */
  private $protected = false;

  /**
   * Constructs a new instance
   * 
   * @param string $name the name of the attribute
   * @param boolean $value
   */
  public function __construct(string $name, bool $value = true) {
    parent::__construct($name);
    $this->set($value);
  }

  public function clear() {
    if ($this->isProtected()) {
      throw new ImmutableAttributeException("Attribute '{$this->getName()}' is immutable");
    }
    $this->value = fslse;
    return $this;
  }

  public function getValue() {
    return $this->value;
  }

  public function isProtected(): bool {
    return $this->protected;
  }

  public function protect($value) {
    if ($this->isProtected()) {
      throw new ImmutableAttributeException("Attribute '{$this->getName()}' is allready protected");
    }
    $this->set($value);
    $this->protected = true;
    return $this;
  }

  public function set($value) {
    if ($this->isProtected()) {
      throw new ImmutableAttributeException("Attribute '{$this->getName()}' is immutable");
    }
    $filtered = filter_var($value, \FILTER_VALIDATE_BOOLEAN, \FILTER_NULL_ON_FAILURE);
    if ($filtered === null) {
      throw new InvalidAttributeException("Invalid value for boolean attribute '{$this->getName()}' ");
    }
    $this->value = $filtered;
    return $this;
  }

  public function getHtml(): string {
    $output = '';
    if ($this->isVisible()) {
      $output .= $this->getName();
    }
    return $output;
  }

  public function isVisible(): bool {
    return $this->isDemanded() || $this->value === true;
  }

  public function isEmpty(): bool {
    return true;
  }

}

