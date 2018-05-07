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
 * Implements an integer attribute with optional valid range
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class IntegerAttribute extends AbstractMutableAttribute {

  /**
   * @var array 
   */
  private $options = [];

  /**
   * @var int|bool 
   */
  private $value = false;

  /**
   * Constructor
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
    return $this->isDemanded() || $this->getValue() !== false || $this->getValue() !== null;
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
