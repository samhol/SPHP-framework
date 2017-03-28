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
   * maximum length of the valid string
   *
   * @var mixed[]
   */
  private $haystack;

  /**
   *
   * @var type 
   */
  private $strict;

  /**
   * Constructs a new validator
   *
   * @param mixed[] $haystack the haystack
   */
  public function __construct(array $haystack = []) {
    parent::__construct();
    $this->haystack = $haystack;
  }

  public function __destruct() {
    unset($this->haystack);
  }

  public function __clone() {
    $this->haystack = Arrays::copy($this->haystack);
  }

  public function getHaystack() {
    return $this->haystack;
  }

  /**
   * Sets the range of the valid string length
   *
   * @param mixed[] $haystack the haystack
   * @return self for a fluent interface
   */
  public function setHaystack(array $haystack) {
    $this->haystack = $haystack;
    return $this;
  }

  public function isStrict() {
    return $this->strict;
  }

  /**
   * 
   * @param  boolean $strict
   * @return self for a fluent interface
   */
  public function setStrict($strict) {
    $this->strict = $strict;
    return $this;
  }

  public function isValid($value) {
    $this->setValue($value);
    $valid = false;
    foreach ($this->haystack as $other) {
      if ($this->isStrict()) {
        $valid = $this->getValue() === $other;
      } else if (is_object($value) && is_object($other)) {
        $valid = $value == $other;
      } else if (!is_object($value) && !is_object($other)) {
        $valid = $value == $other;
      }
      if ($valid) {
        break;
      }
    }
    if (!$valid) {
      $this->createErrorMessage("Value $value is not in collection");
    }
    return $valid;
  }

}
