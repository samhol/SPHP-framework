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
 * Implements jQuery range slider with skin support
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://ionden.com/a/plugins/ion.rangeSlider/en.html ion range slider
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class RangeSlider extends AbstractSlider {

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
    $this->attributes()->protect('data-type', 'double');
    $this->setInitialRange($start, $end);
  }

  /**
   * Returns the separator for double values in input value property
   * 
   * @return string separator for double values in input value property
   */
  public function getInputValuesSeparator(): string {
    $separator = ';';
    if ($this->attributes()->isVisible('data-input-values-separator')) {
      $separator = $this->attributes()->getValue('data-input-values-separator');
    }
    return $separator;
  }

  /**
   * Sets the separator for double values in input value property
   * 
   * @param  string $separator separator for double values in input value property
   * @return $this for a fluent interface
   */
  public function setInputValuesSeparator(string $separator) {
    $this->attributes()->setAttribute('data-input-values-separator', $separator);
    return $this;
  }

  /**
   * Sets the initial selected range of the slider
   * 
   * @param  float $start start of the range
   * @param  float $stop end of the range
   * @return $this for a fluent interface
   * @throws InvalidStateException if the range given is invalid
   */
  public function setInitialRange(float $start, float $stop) {
    if ($start >= $stop) {
      throw new InvalidStateException("Start of initial range is smaller than the end");
    }
    if ($this->getMin() > $start || $this->getMax() < $start) {
      throw new InvalidStateException("Start value: '$start' is not in valid range ({$this->getMin()}-{$this->getMax()})");
    }
    if ($this->getMin() > $stop || $this->getMax() < $stop) {
      throw new InvalidStateException("Stop value: '$stop' is not in valid range ({$this->getMin()}-{$this->getMax()})");
    }
    $this->attributes()->setAttribute('data-from', $start);
    $this->attributes()->setAttribute('data-to', $stop);
    return $this;
  }

  public function setSubmitValue($value) {
    if (func_num_args() == 2) {
      $value = func_get_args();
    } else if (is_string($value)) {
      $value = explode($this->getInputValuesSeparator(), $value, 2);
    }
    if (!is_array($value) || count($value) !== 2) {
      //var_dump($value);
      throw new InvalidStateException('value is not suitable for range slider component');
    }
    $from = reset($value);
    $to = end($value);
    $this->setInitialRange($from, $to);
    return $this;
  }

  /**
   * Returns the start position for left handle
   * 
   * @return float start position for left handle
   */
  public function getFrom(): float {
    return $this->attributes()->getValue('data-from');
  }

  /**
   * Returns the start position for right handle
   * 
   * @return float start position for right handle
   */
  public function getTo(): float {
    return $this->attributes()->getValue('data-to');
  }

}
