<?php

/**
 * SmallerThanValidator.php (UTF-8)
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
  public function __construct($max, $inclusive = true) {
    parent::__construct($inclusive);
    $this->setMin($max);
    $this->createMessageTemplate(static::EXCLUSIVE_ERROR, 'Not in range (%s-%s)');
    $this->createMessageTemplate(static::INCLUSIVE_ERROR, 'Not in inclusive range (%s-%s)');
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
