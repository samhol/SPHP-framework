<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Validators;

/**
 * Validates data against certain haystack
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class InHaystack extends AbstractValidator {

  /**
   * @var array
   */
  private $haystack;

  /**
   * @var boolean 
   */
  private $strict = false;

  /**
   * Constructor
   *
   * @param array $haystack the haystack to validate against
   */
  public function __construct(array $haystack = []) {
    parent::__construct();
    $this->errors()->setTemplate(static::INVALID, 'Value %s is not in collection');
    $this->setHaystack($haystack);
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->haystack);
    parent::__destruct();
  }

  /**
   * Sets the haystack to validate against
   *
   * @param  array $haystack the haystack to validate against
   * @return $this for a fluent interface
   */
  public function setHaystack(array $haystack) {
    $this->haystack = $haystack;
    return $this;
  }

  /**
   * Checks whether the comparison is strict or not
   * 
   * * **Strict** `===` comparison 
   * * **Non strict** `==` comparison
   * 
   * @return boolean true for strict false otherwise
   */
  public function isStrict(): bool {
    return $this->strict;
  }

  /**
   * Sets the comparison type
   * 
   * * **Strict** `===` comparison 
   * * **Non strict** `==` comparison
   * 
   * @param  boolean $strict true for strict false otherwise
   * @return $this for a fluent interface
   */
  public function setStrict(bool $strict) {
    $this->strict = $strict;
    return $this;
  }

  public function isValid($value): bool {
    $this->setValue($value);
    $valid = false;
    foreach ($this->haystack as $other) {
      if ($this->isStrict()) {
        $valid = $this->getValue() === $other;
      } else if (is_scalar($other) xor is_scalar($value)) {
        $valid = false;
      } else {
        $valid = $other == $this->getValue();
      }
      if ($valid) {
        break;
      }
    }
    if (!$valid) {
      $this->errors()->appendErrorFromTemplate(static::INVALID, [$this->getValue()]);
    }
    return $valid;
  }

}
