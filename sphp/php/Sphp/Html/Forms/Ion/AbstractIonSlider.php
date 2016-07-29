<?php

/**
 * AbstractIonSlider.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Ion;

use Sphp\Html\Forms\Inputs\AbstractInputTag as AbstractInputTag;
use Sphp\Html\Forms\SliderInterface as SliderInterface;
use InvalidArgumentException;

/**
 * Class implements jQuery range slider with skin support
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-10-11
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractIonSlider extends AbstractInputTag implements SliderInterface {

  use \Sphp\Html\Forms\InputTrait;

  /**
   * Constructs a new instance of the {@link IonRangeSlider} component
   *
   * @param  int $start the start value of the slider
   * @param  int $end the end value of the slider
   * @param  int $step the length of a single step
   * @throws InvalidArgumentException if the $value is not between the range
   */
  public function __construct($name, $start = 0, $end = 100, $step = 1, $value = 0) {
    parent::__construct("text", $name, $value);
    $this->attrs()->demand("data-sphp-ion-slider");
    $this
            ->setRange($start, $end)
            ->setStepLength($step)
            ->setValue($start);
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
    $this->attrs()->set("data-step", $step);
    return $this;
  }

  /**
   * Sets the range of the values on the slider
   *
   * @param  int $min the start point
   * @param  int $max the end point
   * @return self for PHP Method Chaining
   * @throws InvalidArgumentException if $start > $end
   */
  public function setRange($min = 0, $max = 100) {
    $this->setMin($min)->setMax($max);
    return $this;
  }

  /**
   * Sets the range of the values on the slider
   *
   * @param  int $start the start point
   * @param  int $end the end point
   * @return self for PHP Method Chaining
   * @throws InvalidArgumentException if $start > $end
   */
  public function setMin($start) {
    $this->attrs()->set("data-min", $start);
    return $this;
  }

  /**
   * Sets the range of the values on the slider
   *
   * @param  int $end the end point
   * @return self for PHP Method Chaining
   * @throws InvalidArgumentException if $start > $end
   */
  public function setMax($end) {
    $this->attrs()->set("data-max", $end);
    return $this;
  }

  /**
   * Sets the unit of the slider value
   * 
   * @param  boolean $grid the unit of the value
   * @return self for PHP Method Chaining
   */
  public function useGrid($grid = true) {
    $this->attrs()->set("data-grid", $grid ? "true" : "false");
    return $this;
  }

  /**
   * Sets the unit of the slider value
   * 
   * @param  string $unit the unit of the value
   * @return self for PHP Method Chaining
   */
  public function setPostfix($unit = "") {
    $this->attrs()->set("data-postfix", $unit);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getMax() {
    return $this->attrs()->get("data-max");
  }

  /**
   * {@inheritdoc}
   */
  public function getMin() {
    return $this->attrs()->get("data-min");
  }

}
