<?php

/**
 * RangeSlider.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs\Ion;

use InvalidArgumentException;

/**
 * Implements jQuery range slider with skin support
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://ionden.com/a/plugins/ion.rangeSlider/en.html ion range slider
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class RangeSlider extends AbstractSlider {

  /**
   * Constructs a new instance
   *
   * @param  string|null $name name attribute
   * @param  int $start the start value of the slider
   * @param  int $end the end value of the slider
   * @param  int $step the length of a single step
   * @throws InvalidArgumentException if the $value is not between the range
   */
  public function __construct($name = null, int $start = 0, int $end = 100, int $step = 1) {
    parent::__construct($name, $start, $end, $step, [$start, $end]);
    $this->attrs()->protect('data-type', 'double');
  }

  /**
   * Returns the separator for double values in input value property
   * 
   * @return string separator for double values in input value property
   */
  public function getInputValueSeparator() {
    $separator = ';';
    if ($this->attrs()->exists('data-input-values-separator')) {
      $separator = $this->attrs()->getValue('data-input-values-separator');
    }
    return $separator;
  }

  /**
   * Sets the separator for double values in input value property
   * 
   * @param  string $separator separator for double values in input value property
   * @return $this for a fluent interface
   */
  public function setInputValueSeparator($separator) {
    $this->attrs()->set('data-input-values-separator', $separator);
    return $this;
  }

  /**
   * Sets the value of the value attribute
   *
   * @param  int|int[]|string $value the value of the value attribute
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if parameter(s) are not suitable for range slider
   */
  public function setValue($value) {
    if (func_num_args() == 2) {
      $value = func_get_args();
    } else if (is_string($value)) {
      $value = explode($this->getInputValueSeparator(), $value, 2);
    }
    if (!is_array($value) || count($value) != 2) {
      //var_dump($value);
      throw new InvalidArgumentException('value is not suitable for range slider component');
    }
    $from = reset($value);
    $to = end($value);
    $this->attrs()->set('data-from', $from);
    $this->attrs()->set('data-to', $to);

    parent::setValue($from . $this->getInputValueSeparator() . $to);
    return $this;
  }

  /**
   * Returns the separator for double values in input value property
   * 
   * @return string separator for double values in input value property
   */
  public function getFrom() {
    $rawValue = $this->getValue();
    $arr = explode($this->getInputValueSeparator(), $rawValue, 2);
    return (int) reset($arr);
  }

  /**
   * Returns the separator for double values in input value property
   * 
   * @return string separator for double values in input value property
   */
  public function getTo() {
    $rawValue = $this->getValue();
    $arr = explode($this->getInputValueSeparator(), $rawValue, 2);
    return (int) end($arr);
  }

}
