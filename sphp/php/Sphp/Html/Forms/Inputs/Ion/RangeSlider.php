<?php

/**
 * RangeSlider.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs\Ion;

use Sphp\Html\Exceptions\InvalidStateException;

/**
 * Implements jQuery range slider with skin support
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://ionden.com/a/plugins/ion.rangeSlider/en.html ion range slider
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class RangeSlider extends AbstractSlider {

  private $start;
  private $end;
  
  /**
   * Constructs a new instance
   *
   * @param  string|null $name name attribute
   * @param  int $start the start value of the slider
   * @param  int $end the end value of the slider
   * @param  int $step the length of a single step
   * @throws InvalidStateException if the slider state is invalid
   */
  public function __construct(string $name = null, int $start = 0, int $end = 100, int $step = 1) {
    parent::__construct($name, $start, $end, $step);
    //$this->
    $this->attrs()->protect('data-type', 'double');
  }

  /**
   * Returns the separator for double values in input value property
   * 
   * @return string separator for double values in input value property
   */
  public function getInputValueSeparator(): string {
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
  public function setInputValueSeparator(string $separator) {
    $this->attrs()->set('data-input-values-separator', $separator);
    return $this;
  }


  public function setStartValue(float $value) {
    if ($this->getMin() > $value || $this->getMax() < $value) {
      throw new InvalidStateException("Start value: '$value' is not in valid range ({$this->getMin()}-{$this->getMax()})");
    }
    if ($value >= $this->getTo()) {
      throw new InvalidStateException("Start value: '$value' cannot be larger than end value");
    }
    $this->getStartInput()->setSubmitValue($value);
    $this->attrs()->set("value", $this->start.$this->getInputValueSeparator().$this->end);
    return $this;
  }

  public function setStopValue(float $value) {
    if ($this->getMin() > $value || $this->getMax() < $value) {
      throw new InvalidStateException("Stop value: '$value' is not in valid range ({$this->getMin()}-{$this->getMax()})");
    }
    $this->getEndInput()->setSubmitValue($value);
    $this->attrs()->set("data-initial-stop", $value);
    return $this;
  }
  
  public function setSubmitValue($value) {
    if (func_num_args() == 2) {
      $value = func_get_args();
    } else if (is_string($value)) {
      $value = explode($this->getInputValueSeparator(), $value, 2);
    }
    if (!is_array($value) || count($value) != 2) {
      //var_dump($value);
      throw new InvalidStateException('value is not suitable for range slider component');
    }
    $from = reset($value);
    $to = end($value);
    $this->attrs()->set('data-from', $from);
    $this->attrs()->set('data-to', $to);
    parent::setSubmitValue($from . $this->getInputValueSeparator() . $to);
    return $this;
  }

  /**
   * Returns the separator for double values in input value property
   * 
   * @return string separator for double values in input value property
   */
  public function getFrom() {
    $rawValue = $this->getSubmitValue();
    $arr = explode($this->getInputValueSeparator(), $rawValue, 2);
    return (int) reset($arr);
  }

  /**
   * Returns the separator for double values in input value property
   * 
   * @return string separator for double values in input value property
   */
  public function getTo() {
    $rawValue = $this->getSubmitValue();
    $arr = explode($this->getInputValueSeparator(), $rawValue, 2);
    return (int) end($arr);
  }

}
