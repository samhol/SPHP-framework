<?php

/**
 * Slider.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 */

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Forms\Inputs\HiddenInput;
use Sphp\Html\Forms\Label;
use Sphp\Html\Span;
use Sphp\Html\Adapters\VisibilityAdapter;

/**
 * Slider allows to drag a handle to select a specific value from a range
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/slider.html Foundation Sliders
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Slider extends AbstractSlider {

  /**
   * @var Span
   */
  private $handle;

  /**
   * @var HiddenInput
   */
  private $input;

  /**
   * Constructs a new instance
   *
   * @param int $start the start value of the slider
   * @param int $end the end value of the slider
   * @param int $value the current value of the slider
   * @param int $step the length of a single step
   */
  public function __construct(int $start = 0, int $end = 100, int $value = 0, int $step = 1) {
    parent::__construct($start, $end, $step);
    $this->handle = new Span();
    $this->handle->cssClasses()->protect('slider-handle');
    $this->handle->attrs()
            ->demand('data-slider-handle')
            ->protect('role', 'slider')
            ->protect('tabindex', 1);
    $this->input = new HiddenInput();
    $this->setStepLength($step)->setSubmitValue($value);
  }

  /**
   * Returns the label of the slider
   * 
   * @return Label the label describing the slider
   */
  private function getInnerLabel() {
    
  }

  /**
   * Returns the actual (hidden) form element containing the value of the slider
   * 
   * @return HiddenInput the actual (hidden) form element containing the value of the slider
   */
  private function getInput(): \Sphp\Html\Forms\Inputs\Input {
    return $this->input;
  }

  /**
   * Sets the slider orientation to vertical
   * 
   * @return $this for a fluent interface
   */
  public function setVertical(bool $vertical = true) {
    if ($vertical) {
      $this->cssClasses()->add('vertical');
      $this->attrs()->set('data-vertical', 'true');
    } else {
      $this->cssClasses()->remove('vertical');
      $this->attrs()->set('data-vertical', 'false');
    }
    return $this;
  }

  /**
   * Sets the visibility of the current slider value
   * 
   * @param  boolean $valueVisible true for visible and false for hidden
   * @return $this for a fluent interface
   */
  public function showValue(bool $valueVisible = true) {
    $vis = new VisibilityAdapter($this->getInnerLabel());
    $vis->setHidden(!$valueVisible);
    return $this;
  }

  /**
   * Sets the description text of the slider
   * 
   * @param  string $description the description text of the slider
   * @return $this for a fluent interface
   */
  public function setDescription($description) {
    $this->getInnerLabel()["description"] = "$description ";
    return $this;
  }

  /**
   * Sets the unit of the slider value
   * 
   * @param  string $unit the unit of the value
   * @return $this for a fluent interface
   */
  public function setValueUnit($unit = "") {
    $this->getInnerLabel()["unit"] = " $unit";
    return $this;
  }

  public function disable(bool $disabled = true) {
    parent::disable($disabled);
    $this->getInput()->disable($disabled);
    return $this;
  }

  public function getName() {
    return $this->getInput()->getName();
  }

  public function setName(string $name = null) {
    $this->getInput()->setName($name);
    return $this;
  }

  public function isNamed(): bool {
    return $this->getInput()->isNamed();
  }

  /**
   * Returns the minimum value of the slider
   *
   * @return int the minimum value of the slider
   */
  public function getMin(): float {
    return $this->attrs()->getValue('data-start');
  }

  /**
   * Returns the maximum value of the slider
   *
   * @return int the maximum value of the slider
   */
  public function getMax(): float {
    return $this->attrs()->getValue('data-end');
  }

  public function getSubmitValue() {
    return $this->getInput()->getSubmitValue();
  }

  public function setSubmitValue($value) {
    if ($this->getMin() > $value || $this->getMax() < $value) {
      throw new \InvalidArgumentException("value: '$value' is not in valid range ({$this->getMin()}-{$this->getMax()})");
    }
    $this->getInput()->setSubmitValue($value);
    $this->attrs()->set('data-initial-start', $value);
    return $this;
  }

  /**
   * Sets whether the input must have a value or not before form submission
   * 
   * @param  boolean $required true if the input must have a value before form submission, otherwise false
   * @return $this for a fluent interface
   */
  public function setRequired(bool $required = true) {
    return $this->getInput()->setRequired($required);
  }

  /**
   * Checks whether the input must have a value before form submission
   *
   * @return boolean true if the input must have a value before form submission, false otherwise
   */
  public function isRequired(): bool {
    return $this->getInput()->isRequired();
  }

  public function contentToString(): string {
    return $this->handle . '<span class="slider-fill" data-slider-fill></span>';
  }

  public function bindInput(\Sphp\Html\Forms\Inputs\Input $input = null): \Sphp\Html\Forms\Inputs\Input {
    if ($input === null) {
      $input = new \Sphp\Html\Forms\Inputs\NumberInput();
    }
    $this->input = $input;
    $this->input->setName($this->getName());
    $this->handle->attrs()->set('aria-controls', $input->identify());
    return $input;
  }

}
