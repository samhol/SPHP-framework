<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
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
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class InHaystack extends AbstractValidator {

  private array $haystack;
  private bool $strict = false;

  /**
   * Constructor
   *
   * @param array $haystack the haystack to validate against
   */
  public function __construct(array $haystack = []) {
    parent::__construct('Value is not in haystack'); 
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
   * @return bool true for strict false otherwise
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
   * @param  bool $strict true for strict false otherwise
   * @return $this for a fluent interface
   */
  public function setStrict(bool $strict) {
    $this->strict = $strict;
    return $this;
  }

  public function isValid(mixed $value): bool {
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
      $this->setError(static::INVALID);
    }
    return $valid;
  }

}
