<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs\Ion;

use Sphp\Html\Forms\Inputs\AbstractInputTag;
use Sphp\Html\Forms\Inputs\RangeInput;
use Sphp\Exceptions\InvalidStateException;

/**
 * Implements a jQuery range slider with skin support
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractSlider extends AbstractInputTag implements RangeInput {

  /**
   * Constructor
   *
   * @param  string|null $name name attribute
   * @param  float $start the start value of the slider
   * @param  float $end the end value of the slider
   * @param  float $step the length of a single step
   * @throws InvalidStateException if the slider state is invalid
   */
  public function __construct(string $name = null, float $start = 0, float $end = 100, float $step = 1) {
    parent::__construct('text', $name);
    $this->attributes()->demand('data-sphp-ion-slider');
    $this->setRange($start, $end)
            ->setStepLength($step);
  }

  public function disable(bool $disabled = true) {
    $value = $disabled ? 'true' : null;
    $this->attributes()->set('data-block', $value);
    $this->attributes()->set('data-disable', $value);
    return $this;
  }

  public function isEnabled(): bool {
    return !$this->attributes()->exists('data-disable') && !$this->attributes()->exists('data-block');
  }

  public function setStepLength(float $step = 1) {
    $range = $this->getMax() - $this->getMin();
    if ($step < 0) {
      throw new InvalidStateException("Step value ($step) is below zero");
    }
    if ($step > $range) {
      throw new InvalidStateException("Step value ($step) is bigger than range ($range)");
    }
    $this->attributes()->set('data-step', $step);
    return $this;
  }

  public function setRange(float $min, float $max) {
    $this->attributes()->set('data-min', $min);
    $this->attributes()->set('data-max', $max);
    return $this;
  }

  public function getMin(): float {
    return (float) $this->attributes()->getValue('data-min');
  }

  public function getMax(): float {
    return (float) $this->attributes()->getValue('data-max');
  }

  /**
   * Sets the unit of the slider value
   * 
   * @param  boolean $grid the unit of the value
   * @return $this for a fluent interface
   */
  public function useGrid(bool $grid = true) {
    $this->attributes()->set('data-grid', $grid ? 'true' : 'false');
    return $this;
  }

  /**
   * Sets the number of grid units
   * 
   * @param  int $num the number of grid units
   * @return $this for a fluent interface
   */
  public function setNumberOfGridUnits(int $num = 4) {
    $this->attributes()->set('data-grid-num', $num);
    return $this;
  }

  /**
   * Sets the prefix for values
   * 
   * @param  string $prefix the prefix for values
   * @return $this for a fluent interface
   */
  public function setPrefix(string $prefix) {
    $this->attributes()->set('data-prefix', $prefix);
    return $this;
  }

  /**
   * Sets the postfix for values
   * 
   * @param  string $postfix the postfix for values
   * @return $this for a fluent interface
   */
  public function setPostfix(string $postfix) {
    $this->attributes()->set('data-postfix', $postfix);
    return $this;
  }

}
