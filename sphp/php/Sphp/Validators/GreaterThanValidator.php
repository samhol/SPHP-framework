<?php

/**
 * GreaterThanValidator.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Validators;

/**
 * Validates data against certain minimum value
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class GreaterThanValidator extends AbstractLimitValidator {

  /**
   * @var float 
   */
  private $min;

  /**
   * Constructs a new validator
   * 
   * @param float $min the minimum value
   * @param float $max the maximum value
   * @param boolean $inclusive true for inclusive limit and false for exclusive
   */
  public function __construct(float $min, bool $inclusive = true) {
    parent::__construct($inclusive);
    $this->setMin($min);
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
   * Sets the minimum value
   * 
   * @param  float $min the minimum value
   * @return $this for a fluent interface
   */
  public function setMin(float $min) {
    $this->min = $min;
    return $this;
  }

  public function isValid($value): bool {
    $this->setValue($value);
    if ($this->isInclusive()) {
      if ($this->min > $value) {
        $this->error(static::INCLUSIVE_ERROR);
        return false;
      }
    } else {
      if ($this->min >= $value) {
        $this->error(static::EXCLUSIVE_ERROR);
        return false;
      }
    }
    return true;
  }

}
