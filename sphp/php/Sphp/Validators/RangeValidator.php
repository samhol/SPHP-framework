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
    $this->setMin($min)->setMax($max);
    $this->setMessageTemplate(static::EXCLUSIVE_ERROR, 'Not in range (%s-%s)');
    $this->setMessageTemplate(static::INCLUSIVE_ERROR, 'Not in inclusive range (%s-%s)');
  }

  /**
   * Returns the minimum value
   * 
   * @return float the minimum value
   */
  public function getMin(): float {
    return $this->min;
  }

  /**
   * Returns the maximum value
   * 
   * @return float the maximum value
   */
  public function getMax(): float {
    return $this->max;
  }

  /**
   * Sets the minimum value
   * 
   * @param  float $min the minimum value
   * @return $this for a fluent interface
   */
  public function setMin(float $min) {
    $this->min = $min;
    return $this;
  }

  /**
   * Sets the maximum value
   * 
   * @param  float $max the maximum value
   * @return $this for a fluent interface
   */
  public function setMax(float $max) {
    $this->max = $max;
    return $this;
  }

  public function isValid($value): bool {
    $this->setValue($value);
    if ($this->isInclusive()) {
      if ($this->min > $value || $this->max < $value) {
        $this->error(static::EXCLUSIVE_ERROR, [$this->min, $this->max]);
        return false;
      }
    } else {
      if ($this->min >= $value || $this->max <= $value) {
        $this->error(static::INCLUSIVE_ERROR, [$this->min, $this->max]);
        return false;
      }
    }
    return true;
  }

}
