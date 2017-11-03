<?php

/**
 * Slider.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs\Ion;

use InvalidArgumentException;

/**
 * Implements a jQuery based range slider with skin support
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://ionden.com/a/plugins/ion.rangeSlider/en.html ion slider
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Slider extends AbstractSlider {

  /**
   * Constructs a new instance
   *
   * @param  string|null $name name attribute
   * @param  int $start the start value of the slider
   * @param  int $end the end value of the slider
   * @param  int $step the length of a single step
   */
  public function __construct(string $name = null, int $start = 0, int $end = 100, int $step = 1) {
    parent::__construct($name, $start, $end, $step);
    $this->attrs()->protect('data-type', 'single');
  }

  /**
   * Sets the value of the value attribute
   *
   * @param  int $value the value of the value attribute
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if the $value is not between the range of the slider
   */
  public function setValue($value) {
    if ($this->getMin() > $value || $value > $this->getMax()) {
      throw new InvalidArgumentException("The value ($value) of the slider is not between ({$this->getMin()}-{$this->getMax()})");
    }
    $this->attrs()->set('data-from', $value);
    parent::setValue($value);
    return $this;
  }

}
