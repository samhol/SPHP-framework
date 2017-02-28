<?php

/**
 * InCollectionValidator.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Validators;

use Sphp\Stdlib\StringObject;
use Sphp\Stdlib\Arrays;

/**
 * Validates string length
 *
 *  Validates the length of the given string
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-14
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class InCollectionValidator extends AbstractValidator {

  /**
   * maximum length of the valid string
   *
   * var mixed[]
   */
  private $haystack;

  /**
   *
   * @var type 
   */
  private $mode;

  /**
   * Constructs a new validator
   *
   * @param mixed[] $haystack the haystack
   */
  public function __construct(array $haystack) {
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

  public function getMode() {
    return $this->mode;
  }

  /**
   * 
   * @param \Sphp\Validators\type $mode
   * @return self for a fluent interface
   */
  public function setMode(type $mode) {
    $this->mode = $mode;
    return $this;
  }

  /**
   * Checks whether the validator acts as a range validator or not
   * 
   * @return boolean true if the validator acts as a range validator, false otherwise
   */
  public function isRangeValidator() {
    return $this->min >= 0 && $this->min < $this->max;
  }

  /**
   * Checks whether the validator acts as a upper bound validator or not
   * 
   * @return boolean true if the validator acts as a upper bound validator, false otherwise
   */
  public function isUpperBoundValidator() {
    return $this->min < 0 && $this->max > 0;
  }

  public function isValid($value) {
    $this->setValue($value);
    $valid = true;
    $string = new StringObject($value);
    $length = $string->trim()->length();
    if ($this->isRangeValidator() && !$string->lengthBetween($this->min, $this->max)) {
      $valid = false;
      $this->createErrorMessage("Please insert %d-%d characters", [$this->min, $this->max]);
    } else if ($this->isLowerBoundValidator() && $length < $this->min) {
      $valid = false;
      $this->createErrorMessage("Please insert atleast %d characters", [$this->min]);
    } else if ($this->isUpperBoundValidator() && $length > $this->max) {
      $valid = false;
      $this->createErrorMessage("Please insert at most %d characters", [$this->max]);
    }
    return $valid;
  }

}
