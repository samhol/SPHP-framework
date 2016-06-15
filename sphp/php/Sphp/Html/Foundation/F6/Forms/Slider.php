<?php

/**
 * Slider.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Forms;

use Sphp\Html\AbstractComponent as AbstractComponent;
use Sphp\Html\Forms\SliderInterface as SliderInterface;
use Sphp\Html\Forms\Input\HiddenInput as HiddenInput;
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
class Slider extends AbstractSlider {

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
    $handle = new Span();
    $handle->cssClasses()->lock("slider-handle");
    $handle->attrs()
            ->demand("data-slider-handle")
            ->lock("role", "slider")
            ->lock("tabindex", 1);
    $this->content()["slider"] = $handle;
    $filler = new Span();
    $filler->cssClasses()
            ->lock("slider-fill");
    $filler->attrs()
            ->demand("data-slider-fill");
    $this->content()["slider-fill"] = $filler;
    $input = new HiddenInput();
    $this->content()["input"] = $input;
    $this->setStepLength($step)->setValue($value);
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
  private function getInput() {
    return $this->content("input");
  }

  /**
   * Sets the slider orientation to vertical
   * 
   * @return self for PHP Method Chaining
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
   * Sets the length of the slider step
   *
   * @param  int $step the length of the slider step
   * @return self for PHP Method Chaining
   */
  public function setStepLength($step) {
    if ($step > 0) {
      $this->attrs()->set("data-step", $step);
    } else {
      throw new \InvalidArgumentException();
    }
    return $this;
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
    return $this->getInput()->getName();
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->getInput()->setName($name);
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
    return $this->getInput()->getValue();
  }

  /**
   * {@inheritdoc}
   */
  public function setValue($value) {
    if ($this->getMin() > $value || $this->getMax() < $value) {
      throw new \InvalidArgumentException("value: '$value' is not in valid range ({$this->getMin()}-{$this->getMax()})");
    }
    $this->getInput()->setValue($value);
    $this->attrs()->set("data-initial-start", $value);
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

  public function setRange($start = 0, $end = 100) {
    
  }

}