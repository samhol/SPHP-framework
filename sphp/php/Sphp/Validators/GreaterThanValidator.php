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
 * Validates data against certain minimum value
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
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
    $this->setMessageTemplate(static::EXCLUSIVE_ERROR, 'Not larger than %d');
    $this->setMessageTemplate(static::INCLUSIVE_ERROR, 'Not larger than or equal to %d');
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
        $this->error(static::INCLUSIVE_ERROR, [$this->min]);
        return false;
      }
    } else {
      if ($this->min >= $value) {
        $this->error(static::EXCLUSIVE_ERROR, [$this->min]);
        return false;
      }
    }
    return true;
  }

}
