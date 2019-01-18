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

/**
 * Implements a boolean attribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class BooleanAttribute extends AbstractScalarAttribute {

  /**
   * Constructor
   * 
   * @param string $name the name of the attribute
   * @param boolean $value
   */
  public function __construct(string $name, bool $value = true) {
    parent::__construct($name);
    $this->setValue($value);
  }

  public function __toString(): string {
    $output = '';
    if ($this->isVisible()) {
      $output .= $this->getName();
    }
    return $output;
  }

  public function forceVisibility() {
    if (!$this->isProtected()) {
      $this->protectValue(true);
    }
    parent::demand();
    return $this;
  }

  public function isVisible(): bool {
    return $this->getValue() === true;
  }

  public function isEmpty(): bool {
    return true;
  }

  public function filterValue($value) {
    $filtered = filter_var($value, \FILTER_VALIDATE_BOOLEAN, \FILTER_NULL_ON_FAILURE);
    if ($filtered === null) {
      throw new InvalidAttributeException("Invalid value for boolean attribute '{$this->getName()}'");
    }
    return $filtered;
  }

}
