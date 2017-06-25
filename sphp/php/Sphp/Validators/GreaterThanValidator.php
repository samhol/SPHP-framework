<?php

/**
 * GreaterThanValidator.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Validators;

/**
 * Description of GreaterThanValidator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-03-28
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
  public function __construct($min, $inclusive = true) {
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
  public function getMin() {
    return $this->min;
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
   * {@inheritdoc}
   */
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
