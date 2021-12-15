<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Attributes;

use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;
use Sphp\Html\Attributes\Exceptions\InvalidAttributeValueException;

/**
 * Default implementation of an attribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class ScalarAttribute extends AbstractMutableAttribute {

  /**
   * @var scalar|null 
   */
  private $value = null;

  /**
   * Constructor
   *
   * @param string $name the name of the attribute
   * @param scalar|null $value optional value of the attribute
   */
  public function __construct(string $name, $value = null) {
    parent::__construct($name);
    if ($value !== null) {
      $this->setValue($value);
    }
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

  public function isValidValue($value): bool {
    return is_scalar($value) || $value === null;
  }

  public function setValue($value) {
    if (!$this->isValidValue($value)) {
      throw new InvalidAttributeValueException("Invalid value for '{$this->getName()}' attribute");
    }
    $this->value = $value;
    return $this;
  }

  public function getValue() {
    return $this->value;
  }

  public function clear() {
    $this->value = null;
    return $this;
  }

  public function isBoolean(): bool {
    return is_bool($this->value);
  }

}
