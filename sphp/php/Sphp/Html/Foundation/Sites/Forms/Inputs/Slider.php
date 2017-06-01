<?php

/**
 * Slider.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
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
 * @since   2016-05-17
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/sites/docs/slider.html Foundation 6 Sliders
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Slider extends AbstractSlider {

  /**
   *
   * @var Span
   */
  private $handle;

  /**
   *
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
  public function __construct($start = 0, $end = 100, $value = 0, $step = 1) {
    parent::__construct($start, $end, $step);
    $this->handle = new Span();
    $this->handle->cssClasses()->lock('slider-handle');
    $this->handle->attrs()
            ->demand('data-slider-handle')
            ->lock('role', 'slider')
            ->lock('tabindex', 1);
    $this->input = new HiddenInput();
    $this->setStepLength($step)->setValue($value);
  }

  /**
   * Returns the label of the slider
   * 
   * @return Label the label describing the slider
   */
  private function getInnerLabel() {
  }

  /**
   * Returns the actual (hidden) form element containg the value of the slider
   * 
   * @return HiddenInput the actual (hidden) form element containg the value of the slider
   */
  private function getInput() {
    return $this->input;
  }

  /**
   * Sets the slider orientation to vertical
   * 
   * @return self for a fluent interface
   */
  public function setVertical($vertical = true) {
    if ($vertical) {
      $this->cssClasses()->add("vertical");
      $this->attrs()->set("data-vertical", "true");
    } else {
      $this->cssClasses()->remove("vertical");
      $this->attrs()->set("data-vertical", "false");
    }
    return $this;
  }

  /**
   * Sets the visibility of the current slider value
   * 
   * @param  boolean $valueVisible true for visible and false for hidden
   * @return self for a fluent interface
   */
  public function showValue($valueVisible = true) {
    $vis = new VisibilityAdapter($this->getInnerLabel());
    $vis->setHidden(!$valueVisible);
    return $this;
  }

  /**
   * Sets the description text of the slider
   * 
   * @param  string $description the description text of the slider
   * @return self for a fluent interface
   */
  public function setDescription($description) {
    $this->getInnerLabel()["description"] = "$description ";
    return $this;
  }

  /**
   * Sets the unit of the slider value
   * 
   * @param  string $unit the unit of the value
   * @return self for a fluent interface
   */
  public function setValueUnit($unit = "") {
    $this->getInnerLabel()["unit"] = " $unit";
    return $this;
  }

  public function disable($enabled = true) {
    parent::disable($disabled);
    $this->getInput()->disable($enabled);
    return $this;
  }

  public function getName() {
    return $this->getInput()->getName();
  }

  public function setName($name) {
    $this->getInput()->setName($name);
    return $this;
  }

  public function isNamed() {
    return $this->getInput()->isNamed();
  }

  /**
   * Returns the minimum value of the slider
   *
   * @return int the minimum value of the slider
   */
  public function getMin() {
    return $this->attrs()->get("data-start");
  }

  /**
   * Returns the maximum value of the slider
   *
   * @return int the maximum value of the slider
   */
  public function getMax() {
    return $this->attrs()->get("data-end");
  }

  public function getSubmitValue() {
    return $this->getInput()->getSubmitValue();
  }

  public function setValue($value) {
    if ($this->getMin() > $value || $this->getMax() < $value) {
      throw new \InvalidArgumentException("value: '$value' is not in valid range ({$this->getMin()}-{$this->getMax()})");
    }
    $this->getInput()->setValue($value);
    $this->attrs()->set('data-initial-start', $value);
    return $this;
  }

  /**
   * Sets whether the input must have a value or not before form submission
   * 
   * @param  boolean $required true if the input must have a value before form submission, otherwise false
   * @return self for a fluent interface
   */
  public function setRequired($required = true) {
    return $this->getInput()->setRequired($required);
  }

  /**
   * Checks whether the input must have a value before form submission
   *
   * @return boolean true if the input must have a value before form submission, false otherwise
   */
  public function isRequired() {
    return $this->getInput()->isRequired();
  }

  public function contentToString(): string {
    return $this->handle . '<span class="slider-fill" data-slider-fill></span>' . $this->input;
  }

}
