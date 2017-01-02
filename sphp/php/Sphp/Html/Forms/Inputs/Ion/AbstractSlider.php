<?php

/**
 * AbstractIonSlider.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs\Ion;

use Sphp\Html\Forms\Inputs\AbstractInputTag;
use Sphp\Html\Forms\Inputs\SliderInterface;
use Sphp\Html\Forms\Inputs\InputTrait;
use InvalidArgumentException;

/**
 * Implements jQuery range slider with skin support
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-10-11
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractSlider extends AbstractInputTag implements SliderInterface {

  use InputTrait;

  /**
   * Constructs a new instance
   *
   * @param  string|null $name name attribute
   * @param  int $start the start value of the slider
   * @param  int $end the end value of the slider
   * @param  int $step the length of a single step
   * @param  mixed $value the initial submit value 
   * @throws InvalidArgumentException if the $value is not between the range
   */
  public function __construct($name, $start = 0, $end = 100, $step = 1, $value = null) {
    parent::__construct('text', $name);
    if ($value === null) {
      $value = $start;
    }
    $this->attrs()->demand('data-sphp-ion-slider');
    $this->setRange($start, $end)
            ->setStepLength($step)
            ->setValue($value);
  }

  public function disable($disabled = true) {
    $this->attrs()->set('data-disable', (bool) $disabled);
    return $this;
  }

  /**
   * Sets the length of the slider step
   *
   * @param  int $step the length of the slider step
   * @return self for PHP Method Chaining
   * @throws InvalidArgumentException if the step value is below zero
   */
  public function setStepLength($step = 1) {
    $range = $this->getMax() - $this->getMin();
    if ($step < 0) {
      throw new InvalidArgumentException("Step value ($step) is below zero");
    }
    if ($step > $range) {
      throw new InvalidArgumentException("Step value ($step) is bigger than range ($range)");
    }
    $this->attrs()->set('data-step', $step);
    return $this;
  }

  /**
   * Sets the range of the values on the slider
   *
   * @param  int $min the start point
   * @param  int $max the end point
   * @return self for PHP Method Chaining
   */
  public function setRange($min, $max) {
    $this->setMin($min)->setMax($max);
    return $this;
  }

  /**
   * Sets the range of the values on the slider
   *
   * @param  int $start the start point
   * @param  int $end the end point
   * @return self for PHP Method Chaining
   */
  public function setMin($start) {
    $this->attrs()->set('data-min', $start);
    return $this;
  }

  /**
   * Sets the range of the values on the slider
   *
   * @param  int $end the end point
   * @return self for PHP Method Chaining
   */
  public function setMax($end) {
    $this->attrs()->set('data-max', $end);
    return $this;
  }

  /**
   * Sets the unit of the slider value
   * 
   * @param  boolean $grid the unit of the value
   * @return self for PHP Method Chaining
   */
  public function useGrid($grid = true) {
    $this->attrs()->set('data-grid', $grid ? 'true' : 'false');
    return $this;
  }

  /**
   * Sets the number of grid units
   * 
   * @param  int $num the number of grid units
   * @return self for PHP Method Chaining
   */
  public function setNumberOfGridUnits($num = 4) {
    $this->attrs()->set('data-grid-num', $num);
    return $this;
  }

  /**
   * Sets the prefix for values
   * 
   * @param  string $prefix the prefix for values
   * @return self for PHP Method Chaining
   */
  public function setPrefix($prefix) {
    $this->attrs()->set('data-prefix', $prefix);
    return $this;
  }

  /**
   * Sets the postfix for values
   * 
   * @param  string $postfix the postfix for values
   * @return self for PHP Method Chaining
   */
  public function setPostfix($postfix) {
    $this->attrs()->set('data-postfix', $postfix);
    return $this;
  }

  public function getMax() {
    return $this->attrs()->get('data-max');
  }

  public function getMin() {
    return $this->attrs()->get('data-min');
  }

}
