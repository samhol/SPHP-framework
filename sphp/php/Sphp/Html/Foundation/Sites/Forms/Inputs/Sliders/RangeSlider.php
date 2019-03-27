<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Forms\Inputs\Sliders;

use Sphp\Html\Forms\Inputs\HiddenInput;
use Sphp\Html\Span;
use Sphp\Html\Forms\Inputs\Input;
use Sphp\Html\Forms\Inputs\NumberInput;
use Sphp\Exceptions\InvalidStateException;

/**
 * Slider allows to drag a handle to select a specific value from a range
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/slider.html Foundation Sliders
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class RangeSlider extends AbstractSlider {

  /**
   * @var string
   */
  private $name;

  /**
   * @var Span
   */
  private $lowerHandle;

  /**
   * @var Span
   */
  private $upperHandle;

  /**
   * @var Input
   */
  private $lowerInput;

  /**
   * @var Input
   */
  private $upperInput;

  /**
   * Constructor
   *
   * @param string $name the name of the form input
   * @param float $min the minimum value of the slider
   * @param float $max the maximum value of the slider
   * @param float $step the length of a single step
   */
  public function __construct(string $name = null, float $min = 0, float $max = 100, float $step = 1) {
    parent::__construct($min, $max, $step);
    $this->setOption('data-initial-end', $max);
    $this->lowerHandle = new Span();
    $this->lowerHandle->cssClasses()->protectValue('slider-handle');
    $this->lowerHandle->attributes()
            ->protect('data-slider-handle', true)
            ->protect('role', 'slider')
            ->protect('tabindex', 1);
    $this->upperHandle = new Span();
    $this->upperHandle->cssClasses()->protectValue('slider-handle');
    $this->upperHandle->attributes()
            ->protect('data-slider-handle', true)
            ->protect('role', 'slider')
            ->protect('tabindex', 1);
    $this->lowerInput = (new HiddenInput())->setInitialValue($min);
    $this->upperInput = (new HiddenInput())->setInitialValue($max);
    if ($name !== null) {
      $this->setName($name);
    }
  }

  public function __destruct() {
    unset($this->lowerHandle, $this->upperHandle, $this->lowerInput, $this->upperInput);
    parent::__destruct();
  }

  /**
   * Returns the form component containing the start value of the range
   * 
   * @return Input the form component containing the start value of the range
   */
  private function getStartInput(): Input {
    return $this->lowerInput;
  }

  /**
   * Returns the form component containing the end value of the range
   * 
   * @return Input the form component containing the end value of the range
   */
  private function getEndInput(): Input {
    return $this->upperInput;
  }

  public function disable(bool $disabled = true) {
    parent::disable($disabled);
    $this->getStartInput()->disable($disabled);
    $this->getEndInput()->disable($disabled);
    return $this;
  }

  public function getName(): ?string {
    return $this->name;
  }

  public function setName(string $name = null) {
    $this->name = $name;
    $this->getStartInput()->setName($name . "[start]");
    $this->getEndInput()->setName($name . "[end]");
    return $this;
  }

  public function isNamed(): bool {
    return $this->getStartInput()->isNamed() && $this->getEndInput()->isNamed();
  }

  /**
   * Returns the start value of the slider
   *
   * @return float the start value of the slider
   */
  public function getStartValue() {
    return $this->getStartInput()->getSubmitValue();
  }

  /**
   * 
   * @param  Input $input
   * @return Input
   */
  public function bindStartValueInput(Input $input = null): Input {
    if ($input === null) {
      $input = new NumberInput();
    }
    $this->lowerInput = $input;
    $this->lowerInput->setName($this->getName());
    $this->lowerHandle->attributes()->setAttribute('aria-controls', $input->identify());
    return $input;
  }

  /**
   * 
   * @param  Input $input
   * @return Input
   */
  public function bindStopValueInput(Input $input = null): Input {
    if ($input === null) {
      $input = new NumberInput();
    }
    $this->upperInput = $input;
    $this->upperInput->setName($this->getName());
    $this->upperHandle->attributes()->setAttribute('aria-controls', $input->identify());
    return $input;
  }

  /**
   * Returns the end value of the slider
   *
   * @return float the end value of the slider
   */
  public function getStopValue() {
    return $this->getEndInput()->getSubmitValue();
  }

  public function getSubmitValue() {
    $result = [];
    $result["start"] = $this->getStartValue();
    $result["end"] = $this->getStopValue();
    return $result;
  }

  public function setStartValue(float $value) {
    if ($this->getMin() > $value || $this->getMax() < $value) {
      throw new InvalidStateException("Start value: '$value' is not in valid range ({$this->getMin()}-{$this->getMax()})");
    }
    $this->getStartInput()->setInitialValue($value);
    $this->setOption('data-initial-start', $value);
    return $this;
  }

  public function setStopValue(float $value) {
    if ($this->getMin() > $value || $this->getMax() < $value) {
      throw new InvalidStateException("Stop value: '$value' is not in valid range ({$this->getMin()}-{$this->getMax()})");
    }
    $this->getEndInput()->setInitialValue($value);
    $this->setOption('data-initial-stop', $value);
    return $this;
  }

  public function setInitialValue($value) {
    $min = $this->getStartValue();
    $max = $this->getStopValue();
    if (is_array($value) && count($value) >= 2) {
      $min = (float) array_shift($value);
      $max = (float) array_shift($value);
    } else if ($value < $max) {
      $min = (float) $value;
    } else {
      $max = $value;
    }
    $this->setStartValue($min);
    $this->setStopValue($max);
    return $this;
  }

  public function contentToString(): string {
    return $this->lowerHandle . '<span class="slider-fill" data-slider-fill></span>' . $this->upperHandle . $this->lowerInput . $this->upperInput;
  }
  
  public function buildValueViewer() {
    //$this->identify();
    return new ValueRangeViewer($this->identify());
  }

}
