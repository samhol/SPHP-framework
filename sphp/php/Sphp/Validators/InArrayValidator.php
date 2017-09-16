<?php

/**
 * InArrayValidator.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Validators;

use Sphp\Stdlib\Arrays;

/**
 * Validates string length
 *
 *  Validates the length of the given string
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-03-14
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class InArrayValidator extends AbstractValidator {

  /**
   * @var array
   */
  private $haystack;

  /**
   * @var boolean 
   */
  private $strict;

  /**
   * Constructs a new validator
   *
   * @param array $haystack the haystack
   */
  public function __construct(array $haystack = []) {
    parent::__construct();
    $this->setMessageTemplate(static::INVALID, 'Value %s is not in collection');
    $this->setHaystack($haystack);
  }

  public function __destruct() {
    unset($this->haystack);
  }

  public function __clone() {
    $this->haystack = Arrays::copy($this->haystack);
  }

  public function getHaystack(): array {
    return $this->haystack;
  }

  /**
   * Sets the range of the valid string length
   *
   * @param  array $haystack the haystack
   * @return $this for a fluent interface
   */
  public function setHaystack(array $haystack) {
    $this->haystack = $haystack;
    return $this;
  }

  /**
   * 
   * @return boolean
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
      } else {
        $valid = $value == $other;
      }
      if (!$valid) {
        break;
      }
    }
    if (!$valid) {
      $this->error(static::INVALID, $value);
    }
    return $valid;
  }

}
