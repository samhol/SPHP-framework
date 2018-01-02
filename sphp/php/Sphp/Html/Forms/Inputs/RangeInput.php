<?php

/**
 * SliderInterface.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;
use Sphp\Html\Exceptions\InvalidStateException;
/**
 * Defines a slider for HTML forms
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface RangeInput extends Input {

  /**
   * Sets the length of the slider step
   *
   * @param  float $step the length of the slider step
   * @return $this for a fluent interface
   * @throws InvalidStateException if the step value is below zero or bigger than maximum range
   */
  public function setStepLength(float $step);

  /**
   * Sets the range of the values on the slider
   *
   * @param  float $min the end point
   * @return $this for a fluent interface
   * @throws InvalidStateException if the step value is below zero
   */
  public function setMin(float $min);

  /**
   * Returns the minimum value of the slider
   *
   * @return float the minimum value of the slider
   */
  public function getMin(): float;

  /**
   * Sets the range of the values on the slider
   *
   * @param  float $max the end point
   * @return $this for a fluent interface
   * @throws InvalidStateException if the step value is below zero
   */
  public function setMax(float $max);

  /**
   * Returns the maximum value of the slider
   *
   * @return float the maximum value of the slider
   */
  public function getMax(): float;
}
