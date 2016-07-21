<?php

/**
 * RangeSlider.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Forms;

use Sphp\Html\Forms\Inputs\HiddenInput as HiddenInput;
use Sphp\Html\Forms\Label as Label;
use Sphp\Html\Span as Span;

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
class RangeSlider extends AbstractSlider {

  private $name;

  /**
   * Constructs a new instance
   *
   * @param int $start the start value of the slider
   * @param int $end the end value of the slider
   * @param int $step the length of a single step
   */
  public function __construct($name = null, $min = 0, $max = 100, $step = 1) {
    $this->name = $name;
    parent::__construct($min, $max, $step);
    $this->attrs()->demand("data-initial-end")
            ->set("data-initial-end", $max);
    $handle1 = new Span();
    $handle1->cssClasses()->lock("slider-handle");
    $handle1->attrs()
            ->demand("data-slider-handle")
            ->lock("role", "slider")
            ->lock("tabindex", 1);
    $this->content()["slider1"] = $handle1;
    $filler = new Span();
    $filler->cssClasses()
            ->lock("slider-fill");
    $filler->attrs()
            ->demand("data-slider-fill");
    $this->content()["slider-fill"] = $filler;
    $handle2 = new Span();
    $handle2->cssClasses()->lock("slider-handle");
    $handle2->attrs()
            ->demand("data-slider-handle")
            ->lock("role", "slider")
            ->lock("tabindex", 1);
    $this->content()["slider2"] = $handle2;
    $this->content()["start-input"] = (new HiddenInput())->setValue($min);
    $this->content()["end-input"] = (new HiddenInput())->setValue($max);
    $this->content()["input"] = (new HiddenInput())->setValue("$min;$max");
    if ($name !== null) {
      $this->setName($name);
    }
  }

  /**
   * Returns the label of the slider
   * 
   * @return Label the label describing the slider
   */
  private function getInnerLabel() {
    return $this->content()["label"];
  }

  /**
   * Returns the the actual slider
   * 
   * @return Spam the actual Foundation slider
   */
  private function getSlider() {
    return $this->content("slider");
  }

  /**
   * Returns the actual (hidden) form element containg the value of the slider
   * 
   * @return HiddenInput the actual (hidden) form element containg the value of the slider
   */
  private function getStartInput() {
    return $this->content()->get("start-input");
  }

  /**
   * Returns the actual (hidden) form element containg the value of the slider
   * 
   * @return HiddenInput the actual (hidden) form element containg the value of the slider
   */
  private function getEndInput() {
    return $this->content()->get("end-input");
  }

  /**
   * Sets the visibility of the current slider value
   * 
   * @param  boolean $valueVisible true for visible and false for hidden
   * @return self for PHP Method Chaining
   */
  public function showValue($valueVisible = true) {
    if ($valueVisible) {
      $this->getInnerLabel()->unhide();
    } else {
      $this->getInnerLabel()->hide();
    }
    //$this->valueVisible = $valueVisible;
    return $this;
  }

  /**
   * Sets the description text of the slider
   * 
   * @param  string $description the description text of the slider
   * @return self for PHP Method Chaining
   */
  public function setDescription($description) {
    $this->getInnerLabel()["description"] = "$description ";
    return $this;
  }

  /**
   * Sets the unit of the slider value
   * 
   * @param  string $unit the unit of the value
   * @return self for PHP Method Chaining
   */
  public function setValueUnit($unit = "") {
    $this->getInnerLabel()["unit"] = " $unit";
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function disable($enabled = true) {
    if ($enabled) {
      $this->removeCssClass("disabled");
    } else {
      $this->addCssClass("disabled");
    }
    $this->getInput()->disable($enabled);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isEnabled() {
    return !$this->getInput()->attrExists("disabled");
  }

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->name;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->name = $name;
    $this->getStartInput()->setName($name . "[start]");
    $this->getEndInput()->setName($name . "[end]");
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isNamed() {
    return $this->getInput()->isNamed();
  }

  /**
   * Returns the minimum value of the slider
   *
   * @return int the minimum value of the slider
   */
  public function getStartValue() {
    return $this->getStartInput()->getValue();
  }

  /**
   * Returns the maximum value of the slider
   *
   * @return int the maximum value of the slider
   */
  public function getStopValue() {
    return $this->getEndInput()->getValue();
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

  /**
   * {@inheritdoc}
   */
  public function getValue() {
    $result = [];
    $result["start"] = $this->getStartValue();
    return $this->getInput()->getValue();
  }

  /**
   * {@inheritdoc}
   */
  public function setStartValue($value) {
    $value = (int) $value;
    if ($this->getMin() > $value || $this->getMax() < $value) {
      throw new \InvalidArgumentException("Start value: '$value' is not in valid range ({$this->getMin()}-{$this->getMax()})");
    }
    $this->getStartInput()->setValue($value);
    $this->attrs()->set("data-initial-start", $value);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setStopValue($value) {
    $value = (int) $value;
    if ($this->getMin() > $value || $this->getMax() < $value) {
      throw new \InvalidArgumentException("Stop value: '$value' is not in valid range ({$this->getMin()}-{$this->getMax()})");
    }
    $this->getEndInput()->setValue($value);
    $this->attrs()->set("data-initial-stop", $value);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setValue($value) {
    $min = $this->getStartValue();
    $max = $this->getStopValue();
    if (is_array($value) && count($value) >= 2) {
      $min = (int) array_shift($value);
      $max = (int) array_shift($value);
    } else if ($value < $max) {
      $min = (int) $value;
    } else {
      $max = $value;
    }
    $this->setStartValue($min);
    $this->setStopValue($max);
    return $this;
  }

  /**
   * Sets whether the input must have a value or not before form submission
   * 
   * @param  boolean $required true if the input must have a value before form submission, otherwise false
   * @return self for PHP Method Chaining
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

  public function getLabel() {
    
  }

  public function hasLabel() {
    
  }

  public function setLabel($label) {
    
  }

}
