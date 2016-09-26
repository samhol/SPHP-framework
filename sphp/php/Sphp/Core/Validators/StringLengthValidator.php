<?php

/**
 * StringLengthValidator.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Validators;

use Sphp\Core\Types\StringObject as StringObject;

/**
 * Class validates string length.
 *
 *  Checks that given string is of given length.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-14
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class StringLengthValidator extends AbstractOptionalValidator {

  /**
   * minimum length of the valid string
   *
   * var int
   */
  private $min;

  /**
   * maximum length of the valid string
   *
   * var int
   */
  private $max;

  /**
   * Constructs a new {@link self} validator
   *
   * @param int $min minimum length of the valid string
   * @param int $max maximum length of the valid string
   */
  public function __construct($min = -1, $max = -1) {
    parent::__construct();
    $this->min = intval($min);
    $this->max = intval($max);
  }

  /**
   * Sets the range of the valid string length
   *
   * @param int $min minimum length of the valid string
   * @param int $max maximum length of the valid string
   * @return self for PHP Method Chaining
   */
  public function setRangeValidation($min, $max) {
    $this->min = intval($min);
    $this->max = intval($max);
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
   * Sets the minimum length of the valid string
   * 
   * **Important:** Unsets the maximum length setting making the validator act 
   * as a lower bound validator
   * 
   * @param  int $min minimum length of the valid string
   * @return self for PHP Method Chaining
   */
  public function setLowerBoundValidation($min) {
    $this->min = intval($min);
    $this->max = -1;
    return $this;
  }

  /**
   * Checks whether the validator acts as a lower bound validator or not
   * 
   * @return boolean true if the validator acts as a lower bound validator, false otherwise
   */
  public function isLowerBoundValidator() {
    return $this->min >= 0 && $this->max === -1;
  }

  /**
   * Sets the maximum length of the valid string
   * 
   * **Important:** Unsets the minimum length setting making the validator act 
   * as a upper bound validator
   * 
   * @param int $max maximum length of the valid string
   * @return self for PHP Method Chaining
   */
  public function setUpperBoundValidation($max) {
    $this->min = -1;
    $this->max = intval($max);
    return $this;
  }

  /**
   * Checks whether the validator acts as a upper bound validator or not
   * 
   * @return boolean true if the validator acts as a upper bound validator, false otherwise
   */
  public function isUpperBoundValidator() {
    return $this->min < 0 && $this->max > 0;
  }

  /**
   * Validates the length of the given string
   *
   *  Checks that given string is of given length if it has any content.
   *
   * @param  mixed $value the string to validate
   */
  protected function executeValidation($value) {
    $string = new StringObject($value);
    $length = $string->trim()->length();
    if ($this->isRangeValidator() && !$string->lengthBetween($this->min, $this->max)) {
      $this->createErrorMessage("Please insert %d-%d characters", [$this->min, $this->max]);
    } else if ($this->isLowerBoundValidator() && $length < $this->min) {
      $this->createErrorMessage("Please insert atleast %d characters", [$this->min]);
    } else if ($this->isUpperBoundValidator() && $length > $this->max) {
      $this->createErrorMessage("Please insert at most %d characters", [$this->max]);
    }
  }

}
