<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Attributes;

use Sphp\Html\Attributes\Exceptions\InvalidAttributeException;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;

/**
 * Implements a boolean attribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-10-24
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class BooleanAttribute extends AbstractMutableAttribute {

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
    $this->value = false;
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
      throw new InvalidAttributeException("Invalid value for boolean attribute '{$this->getName()}'");
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
