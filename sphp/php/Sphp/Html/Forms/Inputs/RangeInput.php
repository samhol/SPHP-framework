<?php

/**
 * SliderInterface.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\Exceptions\InvalidStateException;

/**
 * Defines a range input for HTML forms
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface RangeInput extends Input {

  /**
   * Sets the length of the individual step
   *
   * @param  float $step the length of the slider step
   * @return $this for a fluent interface
   * @throws InvalidStateException if the step value is below zero or bigger than maximum range
   */
  public function setStepLength(float $step);

  /**
   * Sets the minimum and maximum values
   *
   * @param  float $min the start point
   * @param  float $max the end point
   * @return $this for a fluent interface
   * @throws InvalidStateException if the range is not valid
   */
  public function setRange(float $min, float $max);

  /**
   * Returns the minimum value of the slider
   *
   * @return float the minimum value of the slider
   */
  public function getMin(): float;

  /**
   * Returns the maximum value of the slider
   *
   * @return float the maximum value of the slider
   */
  public function getMax(): float;
}
