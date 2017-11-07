<?php

/**
 * Attribute.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;
use Sphp\Html\Attributes\Exceptions\InvalidAttributeException;

/**
 * Default implementation of an attribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Attribute extends AbstractAttribute {

  /**
   * @var mixed 
   */
  private $value = false;

  /**
   * Constructs a new instance
   *
   * @param string $name the name of the attribute
   * @param scalar $value optional value of the attribute
   */
  public function __construct(string $name, $value = false) {
    parent::__construct($name);
    if ($value !== false) {
      $this->set($value);
    }
  }

  public function set($value) {
    if ($this->isProtected()) {
      throw new ImmutableAttributeException("Attribute '{$this->getName()}' is immutable");
    }
    if (!is_scalar($value) && $value !== null) {
      throw new InvalidAttributeException("Invalid value for '{$this->getName()}' attribute");
    }
    $this->value = $value;
    return $this;
  }

  public function getValue() {
    return $this->value;
  }

  public function clear() {
    if ($this->isProtected()) {
      throw new ImmutableAttributeException("Attribute '{$this->getName()}' is immutable");
    }
    $this->value = false;
    return $this;
  }

  public function isBoolean(): bool {
    return is_bool($this->value);
  }

}
