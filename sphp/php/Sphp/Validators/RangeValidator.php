<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Validators;

use Sphp\Exceptions\InvalidArgumentException;

/**
 * Validates data against certain numeric range
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class RangeValidator extends AbstractLimitValidator {

  /**
   * @var float 
   */
  private $min;

  /**
   * @var float 
   */
  private $max;

  /**
   * Constructs a new validator
   * 
   * @param float $min the minimum value
   * @param float $max the maximum value
   * @param boolean $inclusive
   */
  public function __construct(float $min, float $max, bool $inclusive = true) {
    parent::__construct($inclusive);
    $this->setRange($min, $max);
    $this->setMessageTemplate(static::EXCLUSIVE_ERROR, 'Not in range (%s, %s)');
    $this->setMessageTemplate(static::INCLUSIVE_ERROR, 'Not in inclusive range (%s, %s)');
  }

  private function integrityCheck() {
    if ($this->min >= $this->max && !$this->isInclusive()) {
      throw new InvalidArgumentException("Non-inclusive range ($this->min, $this->max) is not valid");
    } else if ($this->min > $this->max && $this->isInclusive()) {
      throw new InvalidArgumentException("Inclusive range ($this->min, $this->max) is not valid");
    }
  }

  public function setInclusive(bool $inclusive) {
    parent::setInclusive($inclusive);
    $this->integrityCheck();
    return $this;
  }

  /**
   * Sets the valid range
   * 
   * @param  float $min the minimum value
   * @param  float $max the maximum value
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if the range contains no possible values
   */
  public function setRange(float $min, float $max) {
    $this->min = $min;
    $this->max = $max;
    $this->integrityCheck();
    return $this;
  }

  public function isValid($value): bool {
    $this->setValue($value);
    if ($this->isInclusive()) {
      if ($this->min > $value || $this->max < $value) {
        $this->errorFromTemplate(static::INCLUSIVE_ERROR, [$this->min, $this->max]);
        return false;
      }
    } else {
      if ($this->min >= $value || $this->max <= $value) {
        $this->errorFromTemplate(static::EXCLUSIVE_ERROR, [$this->min, $this->max]);
        return false;
      }
    }
    return true;
  }

}
