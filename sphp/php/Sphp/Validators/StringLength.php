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

use Sphp\Stdlib\MbString;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Validates string length
 *
 *  Validates the length of the given string
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class StringLength extends AbstractValidator {

  public const TOO_SHORT = 'TOO_SHORT';
  public const TOO_LONG = 'TOO_LONG';
  public const NOT_IN_RANGE = 'NOT_IN_RANGE';

  /**
   * minimum length of the valid string
   */
  private ?int $min;

  /**
   * maximum length of the valid string
   */
  private ?int $max;

  /**
   * Constructs a new validator
   *
   * @param int $min minimum length of the valid string
   * @param int $max maximum length of the valid string
   */
  public function __construct(int $min = null, int $max = null) {
    parent::__construct('Invalid type given. String expected');
    if ($min !== null && $max !== null) {
      $this->setRangeValidation($min, $max);
    } else if ($min !== null) {
      $this->setLowerBoundValidation($min);
    } else if ($max !== null) {
      $this->setUpperBoundValidation($max);
    } else {
      throw new InvalidArgumentException("Paramaters are invalid: min: $min, max: $max given");
    }

    $this->getMessages()->setParameter(':min', $this->min);
    $this->getMessages()->setParameter(':max', $this->max);
    $this->getMessages()->setTemplate(static::TOO_SHORT, 'String is less than :min characters long');
    $this->getMessages()->setTemplate(static::TOO_LONG, 'The input is more than :max characters long');
    $this->getMessages()->setTemplate(static::NOT_IN_RANGE, 'The input length is not in range (:min-:max)');
  }

  /**
   * Sets the range of the valid string length
   *
   * @param  int $min minimum length of the valid string
   * @param  int $max maximum length of the valid string
   * @return $this for a fluent interface
   * @throws InvalidArgumentException
   */
  public function setRangeValidation(int $min, int $max) {
    if ($min < 0 || $min > $max) {
      throw new InvalidArgumentException("Given Range ($min - $max) is invalid");
    }
    $this->min = $min;
    $this->max = $max;
    
    $this->getMessages()->setParameter(':min', $this->min);
    $this->getMessages()->setParameter(':max', $this->max);
    return $this;
  }

  /**
   * Checks whether the validator acts as a range validator or not
   * 
   * @return bool true if the validator acts as a range validator, false otherwise
   */
  public function isRangeValidator(): bool {
    return $this->min !== null && $this->max !== null;
  }

  /**
   * Sets the minimum length of the valid string
   * 
   * **Important:** Unsets the maximum length setting making the validator act 
   * as a lower bound validator
   * 
   * @param  int $min minimum length of the valid string
   * @return $this for a fluent interface
   */
  public function setLowerBoundValidation(int $min) {
    $this->min = $min;
    $this->max = null;
    $this->getMessages()->setParameter(':min', $this->min);
    $this->getMessages()->setParameter(':max', $this->max);
    return $this;
  }

  /**
   * Checks whether the validator acts as a lower bound validator or not
   * 
   * @return bool true if the validator acts as a lower bound validator, false otherwise
   */
  public function isLowerBoundValidator(): bool {
    return $this->min >= 0 && $this->max === null;
  }

  /**
   * Sets the maximum length of the valid string
   * 
   * **Important:** Unsets the minimum length setting making the validator act 
   * as a upper bound validator
   * 
   * @param  int $max maximum length of the valid string
   * @return $this for a fluent interface
   * @throws InvalidArgumentException
   */
  public function setUpperBoundValidation(int $max) {
    if ($max < 0) {
      throw new InvalidArgumentException("Upper bound must be zero or a positive integer: $max given");
    }
    $this->min = null;
    $this->max = $max;
    $this->getMessages()->setParameter(':min', $this->min);
    $this->getMessages()->setParameter(':max', $this->max);
    return $this;
  }

  /**
   * Checks whether the validator acts as a upper bound validator or not
   * 
   * @return bool true if the validator acts as a upper bound validator, false otherwise
   */
  public function isUpperBoundValidator(): bool {
    return $this->min === null && $this->max > 0;
  }

  public function isValid(mixed $value): bool {
    $this->setValue($value);
    if (!is_string($value)) {
      $this->setError(self::INVALID);
      return false;
    }
    $valid = true;
    $string = new MbString($value);
    $length = $string->count();
    if ($this->isRangeValidator() && ($length < $this->min || $this->max < $length)) {
      $valid = false;
      $this->setError(self::NOT_IN_RANGE);
    } else if ($this->isLowerBoundValidator() && $length < $this->min) {
      $valid = false;
      $this->setError(self::TOO_SHORT);
    } else if ($this->isUpperBoundValidator() && $length > $this->max) {
      $valid = false;
      $this->setError(self::TOO_LONG);
    }
    return $valid;
  }

}
