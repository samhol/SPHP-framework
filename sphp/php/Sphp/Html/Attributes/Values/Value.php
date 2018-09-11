<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Attributes\Values;

/**
 * Description of Value
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Value {

  /**
   * @var scalar|null 
   */
  private $value = false;

  /**
   * whether the attribute is required or not
   *
   * @var boolean
   */
  private $required = false;

  /**
   * @var boolean 
   */
  private $protected = false;

  /**
   * Constructor
   *
   * @param string $name the name of the attribute
   * @param scalar|null $value optional value of the attribute
   */
  public function __construct($value = false) {
    $this->set($value);
  }

  public function __toString(): string {
    $output = '';
    if ($this->isVisible()) {
      $output .= $this->getName();
      if (!$this->isEmpty()) {
        $value = $this->getValue();
        if (is_string($value)) {
          $value = preg_replace('/[\t\n\r]+/', ' ', $value);
          $output .= '="' . htmlspecialchars($value, \ENT_COMPAT | \ENT_DISALLOWED | \ENT_HTML5, 'utf-8', false) . '"';
        } else {
          $output .= '="' . $value . '"';
        }
      }
    }
    return $output;
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

  public function isVisible(): bool {
    return $this->isDemanded() || ($this->getValue() !== false && $this->getValue() !== null);
  }

  public function isProtected(): bool {
    return $this->protected;
  }

  public function isDemanded(): bool {
    return $this->required || $this->isProtected();
  }

  public function isBoolean(): bool {
    return is_bool($this->value);
  }

  public function isString(): bool {
    return is_string($this->value);
  }

}
