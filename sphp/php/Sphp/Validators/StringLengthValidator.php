<?php

/**
 * StringLengthValidator.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Validators;

use Sphp\Stdlib\StringObject;

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
class StringLengthValidator extends AbstractValidator {

  const TOO_SHORT = '_short_';
  const TOO_LONG = '_long_';

  /**
   * minimum length of the valid string
   *
   * @var int
   */
  private $min;

  /**
   * maximum length of the valid string
   *
   * @var int
   */
  private $max;

  /**
   * Constructs a new validator
   *
   * @param int $min minimum length of the valid string
   * @param int $max maximum length of the valid string
   */
  public function __construct($min = -1, $max = -1) {
    parent::__construct();
    $this->min = intval($min);
    $this->max = intval($max);
    $this->createMessageTemplate(static::INVALID, 'Invalid type given. String expected');
    $this->createMessageTemplate(static::TOO_SHORT, 'The input is less than %d characters long');
    $this->createMessageTemplate(static::TOO_LONG, 'The input is more than %d characters long');
  }

  /**
   * Sets the range of the valid string length
   *
   * @param int $min minimum length of the valid string
   * @param int $max maximum length of the valid string
   * @return self for a fluent interface
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
   * @return self for a fluent interface
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
   * @return self for a fluent interface
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
   * {@inheritdoc}
   */
  public function isValid($value) {
    $this->setValue($value);
    $valid = true;
    $string = new StringObject($value);
    $length = $string->length();
    if ($this->isRangeValidator() && !$string->lengthBetween($this->min, $this->max)) {
      $valid = false;
      $this->createErrorMessage("Please insert atleast %d characters", [$this->min]);
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
