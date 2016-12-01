<?php

/**
 * RangeSlider.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Forms\Inputs\HiddenInput;
use Sphp\Html\Forms\Label;
use Sphp\Html\Span;

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
   *
   * @var Span
   */
  private $lowerHandle;

  /**
   *
   * @var Span
   */
  private $upperHandle;

  /**
   *
   * @var HiddenInput
   */
  private $lowerInput;

  /**
   *
   * @var HiddenInput
   */
  private $upperInput;

  /**
   * Constructs a new instance
   *
   * @param  string $name the name of the form input
   * @param int $min the minimum value of the slider
   * @param int $max the maximum value of the slider
   * @param int $step the length of a single step
   */
  public function __construct($name = null, $min = 0, $max = 100, $step = 1) {
    parent::__construct($min, $max, $step);
    $this->attrs()->demand('data-initial-end')
            ->set('data-initial-end', $max);
    $this->lowerHandle = new Span();
    $this->lowerHandle->cssClasses()->lock('slider-handle');
    $this->lowerHandle->attrs()
            ->demand("data-slider-handle")
            ->lock("role", "slider")
            ->lock("tabindex", 1);
    $this->upperHandle = new Span();
    $this->upperHandle->cssClasses()->lock("slider-handle");
    $this->upperHandle->attrs()
            ->demand('data-slider-handle')
            ->lock('role', 'slider')
            ->lock('tabindex', 1);
    $this->lowerInput = (new HiddenInput())->setValue($min);
    $this->upperInput = (new HiddenInput())->setValue($max);
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
    //return $this->content()["label"];
  }

  /**
   * Returns the actual (hidden) form element containg the value of the slider
   * 
   * @return HiddenInput the actual (hidden) form element containg the value of the slider
   */
  private function getStartInput() {
    return $this->lowerInput;
  }

  /**
   * Returns the actual (hidden) form element containg the value of the slider
   * 
   * @return HiddenInput the actual (hidden) form element containg the value of the slider
   */
  private function getEndInput() {
    return $this->upperInput;
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

  public function disable($disabled = true) {
    parent::disable($disabled);
    $this->getStartInput()->disable($disabled);
    $this->getStopValue()->disable($disabled);
    return $this;
  }

  public function getName() {
    return $this->name;
  }

  public function setName($name) {
    $this->name = $name;
    $this->getStartInput()->setName($name . "[start]");
    $this->getEndInput()->setName($name . "[end]");
    return $this;
  }

  public function isNamed() {
    return $this->getStartInput()->isNamed() && $this->getEndInput()->isNamed();
  }

  /**
   * Returns the start value of the slider
   *
   * @return int the start value of the slider
   */
  public function getStartValue() {
    return $this->getStartInput()->getSubmitValue();
  }

  /**
   * Returns the end value of the slider
   *
   * @return int the end value of the slider
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

  public function setStartValue($value) {
    $value = (int) $value;
    if ($this->getMin() > $value || $this->getMax() < $value) {
      throw new \InvalidArgumentException("Start value: '$value' is not in valid range ({$this->getMin()}-{$this->getMax()})");
    }
    $this->getStartInput()->setValue($value);
    $this->attrs()->set("data-initial-start", $value);
    return $this;
  }

  public function setStopValue($value) {
    $value = (int) $value;
    if ($this->getMin() > $value || $this->getMax() < $value) {
      throw new \InvalidArgumentException("Stop value: '$value' is not in valid range ({$this->getMin()}-{$this->getMax()})");
    }
    $this->getEndInput()->setValue($value);
    $this->attrs()->set("data-initial-stop", $value);
    return $this;
  }

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

  public function contentToString() {
    return $this->lowerHandle . '<span class="slider-fill" data-slider-fill></span>' . $this->upperHandle . $this->lowerInput . $this->upperInput;
  }

}
