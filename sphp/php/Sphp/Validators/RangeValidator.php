<?php

/**
 * RangeValidator.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Validators;

/**
 * Description of RangeValidator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-05-03
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
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
  public function __construct($min, $max, $inclusive = true) {
    parent::__construct($inclusive);
    $this->setMin($min)->setMax($max);
    $this->createMessageTemplate(static::EXCLUSIVE_ERROR, 'Not in range (%s-%s)');
    $this->createMessageTemplate(static::INCLUSIVE_ERROR, 'Not in inclusive range (%s-%s)');
  }

  /**
   * Returns the minimum value
   * 
   * @return float the minimum value
   */
  public function getMin() {
    return $this->min;
  }

  /**
   * Returns the maximum value
   * 
   * @return float the maximum value
   */
  public function getMax() {
    return $this->max;
  }

  /**
   * Sets the minimum value
   * 
   * @param  float $min the minimum value
   * @return self for a fluent interface
   */
  public function setMin($min) {
    $this->min = $min;
    return $this;
  }

  /**
   * Sets the maximum value
   * 
   * @param  float $max the maximum value
   * @return self for a fluent interface
   */
  public function setMax($max) {
    $this->max = $max;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isValid($value) {
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
