<?php

/**
 * IntegerAttribute.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

use Sphp\Html\Attributes\Exceptions\InvalidAttributeException;

/**
 * Implements an integer attribute with optional valid range
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class IntegerAttribute extends AbstractAttribute {

  /**
   * @var array 
   */
  private $options = [];

  /**
   * @var int|bool 
   */
  private $value = false;

  /**
   * Constructs a new instance
   *
   * @param string $name the name of the attribute
   * @param int|null $min optional minimum value
   * @param int|null $max optional maximum value
   */
  public function __construct(string $name, int $min = null, int $max = null) {
    parent::__construct($name);
    if ($min !== null) {
      $this->options['options']['min_range'] = $min;
    }
    if ($max !== null) {
      $this->options['options']['max_range'] = $max;
    }
  }

  public function getValue() {
    return $this->value;
  }

  public function set($value) {
    if ($this->isProtected()) {
      throw new ImmutableAttributeException("Attribute '{$this->getName()}' is immutable");
    }
    if ($value === null || $value === false) {
      $this->value = false;
    } else {
      $filtered = filter_var($value, \FILTER_VALIDATE_INT, $this->options);
      if ($filtered === false) {
        throw new InvalidAttributeException("Invalid value '$value' for '{$this->getName()}' integer attribute");
      }
      $this->value = $filtered;
    }
    return $this;
  }

  public function getHtml(): string {
    $output = '';
    if ($this->isVisible()) {
      $output .= $this->getName();
      if (!$this->isEmpty()) {
        $output .= '="' . $this->getValue() . '"';
      }
    }
    return $output;
  }

  public function isVisible(): bool {
    return $this->isDemanded() || $this->getValue() !== false;
  }

  public function isEmpty(): bool {
    return $this->getValue() === false;
  }

  public function clear() {
    if (!$this->isProtected()) {
      $this->set(false);
    }
    return $this;
  }

}

