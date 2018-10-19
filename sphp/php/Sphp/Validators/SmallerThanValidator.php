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
   * Constructor
   * 
   * @param float $max the maximum value
   * @param boolean $inclusive true for inclusive limit and false for exclusive
   */
  public function __construct(float $max, bool $inclusive = true) {
    parent::__construct($inclusive);
    $this->setMax($max);
    $this->setMessageTemplate(static::EXCLUSIVE_ERROR, 'Not smaller than %d');
    $this->setMessageTemplate(static::INCLUSIVE_ERROR, 'Not smaller than or equal to %d');
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
      if ($this->max < $value) {
        $this->errorFromTemplate(static::INCLUSIVE_ERROR, [$this->max]);
        return false;
      }
    } else {
      if ($this->max <= $value) {
        $this->errorFromTemplate(self::EXCLUSIVE_ERROR, [$this->max]);
        return false;
      }
    }
    return true;
  }

}
