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
 * Validates data against certain maximum value
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class SmallerThanValidator extends AbstractLimitValidator {

  /**
   * @var float 
   */
  private $max;

  /**
   * Constructs a new validator
   * 
   * @param float $max the maximum value
   * @param boolean $inclusive true for inclusive limit and false for exclusive
   */
  public function __construct(float $max, bool $inclusive = true) {
    parent::__construct($inclusive);
    $this->setMin($max);
    $this->setMessageTemplate(static::EXCLUSIVE_ERROR, 'Not in range (%s-%s)');
    $this->setMessageTemplate(static::INCLUSIVE_ERROR, 'Not in inclusive range (%s-%s)');
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
   * Sets the maximum value
   * 
   * @param  float $max the maximum value
   * @return $this for a fluent interface
   */
  public function setMax($max) {
    $this->max = $max;
    return $this;
  }

  public function isValid($value): bool {
    $this->setValue($value);
    if ($this->isInclusive()) {
      if ($this->max > $value) {
        $this->error(static::EXCLUSIVE_ERROR);
        return false;
      }
    } else {
      if ($this->max >= $value) {
        $this->error(self::NOT_GREATER);
        return false;
      }
    }
    return true;
  }

}
