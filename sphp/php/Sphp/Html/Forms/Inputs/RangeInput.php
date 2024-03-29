<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs;

use Sphp\Exceptions\InvalidStateException;

/**
 * Defines a range input for HTML forms
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface RangeInput extends Input {

  /**
   * Sets the length of the individual step
   *
   * @param  float|null $step the length of the slider step
   * @return $this for a fluent interface
   * @throws InvalidStateException if the step value is below zero or bigger than maximum range
   */
  public function setStepLength(?float $step);

  /**
   * Sets the minimum and maximum values
   *
   * @param  float|null $min the start point
   * @param  float|null $max the end point
   * @return $this for a fluent interface
   * @throws InvalidStateException if the range is not valid
   */
  public function setRange(?float $min, ?float $max);

  /**
   * Returns the minimum value of the slider
   *
   * @return float|null the minimum value of the slider
   */
  public function getMin(): ?float;

  /**
   * Returns the maximum value of the slider
   *
   * @return float|null the maximum value of the slider
   */
  public function getMax(): ?float;
}
