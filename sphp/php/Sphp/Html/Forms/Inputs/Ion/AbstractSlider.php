<?php

/**
 * SPHPlayground Framework (http://playground.samiholck.com/)
 * 
 * @copyright Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 */

namespace Sphp\Html\Forms\Inputs\Ion;

use Sphp\Html\Forms\Inputs\AbstractInputTag;
use Sphp\Html\Forms\Inputs\RangeInput;
use Sphp\Html\Exceptions\InvalidStateException;

/**
 * Implements a jQuery range slider with skin support
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractSlider extends AbstractInputTag implements RangeInput {

  /**
   * Constructs a new instance
   *
   * @param  string|null $name name attribute
   * @param  float $start the start value of the slider
   * @param  float $end the end value of the slider
   * @param  float $step the length of a single step
   * @param  float $value the initial submit value 
   * @throws InvalidStateException if the slider state is invalid
   */
  public function __construct(string $name = null, float $start = 0, float $end = 100, float $step = 1) {
    parent::__construct('text', $name);
    $this->attrs()->demand('data-sphp-ion-slider');
    $this->setRange($start, $end)
            ->setStepLength($step);
  }

  public function disable(bool $disabled = true) {
    $value = $disabled ? 'true' : null;
    $this->attrs()->set('data-block', $value);
    $this->attrs()->set('data-disable', $value);
    return $this;
  }

  public function isEnabled(): bool {
    return !$this->attrs()->exists('data-disable') && !$this->attrs()->exists('data-block');
  }

  public function setStepLength(float $step = 1) {
    $range = $this->getMax() - $this->getMin();
    if ($step < 0) {
      throw new InvalidStateException("Step value ($step) is below zero");
    }
    if ($step > $range) {
      throw new InvalidStateException("Step value ($step) is bigger than range ($range)");
    }
    $this->attrs()->set('data-step', $step);
    return $this;
  }

  public function setRange(float $min, float $max) {
    $this->attrs()->set('data-min', $min);
    $this->attrs()->set('data-max', $max);
    return $this;
  }

  public function getMin(): float {
    return (float) $this->attrs()->getValue('data-min');
  }

  public function getMax(): float {
    return (float) $this->attrs()->getValue('data-max');
  }

  /**
   * Sets the unit of the slider value
   * 
   * @param  boolean $grid the unit of the value
   * @return $this for a fluent interface
   */
  public function useGrid(bool $grid = true) {
    $this->attrs()->set('data-grid', $grid ? 'true' : 'false');
    return $this;
  }

  /**
   * Sets the number of grid units
   * 
   * @param  int $num the number of grid units
   * @return $this for a fluent interface
   */
  public function setNumberOfGridUnits(int $num = 4) {
    $this->attrs()->set('data-grid-num', $num);
    return $this;
  }

  /**
   * Sets the prefix for values
   * 
   * @param  string $prefix the prefix for values
   * @return $this for a fluent interface
   */
  public function setPrefix(string $prefix) {
    $this->attrs()->set('data-prefix', $prefix);
    return $this;
  }

  /**
   * Sets the postfix for values
   * 
   * @param  string $postfix the postfix for values
   * @return $this for a fluent interface
   */
  public function setPostfix(string $postfix) {
    $this->attrs()->set('data-postfix', $postfix);
    return $this;
  }

}
