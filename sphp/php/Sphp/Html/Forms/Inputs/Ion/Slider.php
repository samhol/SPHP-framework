<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs\Ion;

use Sphp\Exceptions\InvalidStateException;

/**
 * Implements a jQuery based range slider with skin support
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://ionden.com/a/plugins/ion.rangeSlider/en.html ion slider
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Slider extends AbstractSlider {

  /**
   * Constructor
   *
   * @param  string|null $name name attribute
   * @param  int $start the start value of the slider
   * @param  int $end the end value of the slider
   * @param  int $step the length of a single step
   * @throws InvalidStateException if the slider state is invalid
   */
  public function __construct(string $name = null, int $start = 0, int $end = 100, int $step = 1) {
    parent::__construct($name, $start, $end, $step);
    $this->attributes()->protect('data-type', 'single');
  }

  /**
   * Sets the value of the value attribute
   *
   * @param  mixed $value the value of the value attribute
   * @return $this for a fluent interface
   * @throws InvalidStateException if the $value is not between the range of the slider
   */
  public function setSubmitValue($value) {
    if ($this->getMin() > $value || $value > $this->getMax()) {
      throw new InvalidStateException("The value ($value) of the slider is not between ({$this->getMin()}-{$this->getMax()})");
    }
    $this->attributes()->setAttribute('data-from', $value);
    parent::setInitialValue($value);
    return $this;
  }

}
