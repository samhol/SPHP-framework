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

use Sphp\Stdlib\Strings;
use Sphp\Html\Attributes\Exceptions\InvalidAttributeValueException;

/**
 * Implements a regular expression validable attribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class PatternAttribute extends AbstractMutableAttribute {

  private string $pattern;

  /**
   * @var scalar|null 
   */
  private $value = null;

  /**
   * Constructor
   *
   * @param string $name the name of the attribute
   * @param string $pattern
   * @param mixed $value
   */
  public function __construct(string $name, string $pattern, $value = null) {
    $this->pattern = $pattern;
    parent::__construct($name);
    $this->setValue($value);
  }

  public function isValidValue($value): bool {
    return $value === null || 
            ((is_string($value) || is_numeric($value)) && Strings::match((string) $value, $this->pattern));
  }

  public function clear() {
    $this->value = null;
    return $this;
  }

  public function getValue() {
    return $this->value;
  }

  public function setValue($value) {
    if (!$this->isValidValue($value)) {
      throw new InvalidAttributeValueException("Invalid value for '{$this->getName()}' attribute");
    }
    $this->value = $value;
    return $this;
  }

}
