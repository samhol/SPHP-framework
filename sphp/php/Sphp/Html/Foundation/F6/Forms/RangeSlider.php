<?php

/**
 * RangeSlider.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Forms;

use Sphp\Html\AbstractComponent as AbstractComponent;
use Sphp\Html\Forms\InputInterface as InputInterface;
use Sphp\Html\Forms\Input\HiddenInput as HiddenInput;
use Sphp\Html\Forms\Label as Label;
use Sphp\Html\Div as Div;
use Sphp\Html\Span as Span;
use Sphp\Util\Arrays as Arrays;

/**
 * RangeSlider allows you to drag a handle to select a specific value from a range
 *
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-05-17
 * @version 1.0.0
 * @filesource
 */
class RangeSlider extends AbstractComponent implements InputInterface {

  const START = "start";
  const END = "end";
  const STEP = "step";

  /**
   * Foundation range slider options
   *
   * @var mixed[]
   */
  private $options = [
      self::START => 0,
      self::STEP => 1,
      self::END => 100
  ];

  /**
   * Constructs a new instance
   *
   * @param int $start the start value of the slider
   * @param int $end the end value of the slider
   * @param int $step the length of a single step
   * @param int $value the current value of the slider
   */
  public function __construct($start = 0, $end = 100, $step = 1, $value = 0) {
    parent::__construct("div");
    $label = (new Label())->identify();
    $label["description"] = "";
    $label["value"] = (new Span())
            ->setCssClass("sphp-range-slider-value");
    $label["unit"] = "";
    $this->content()["label"] = $label;
    $this->content()->offsetSet("slider", (new Div())
                    ->addCssClass("range-slider")
                    ->setAttr("data-slider"));
    $this->getSlider()["handle"] = (new Span())
            ->addCssClass("range-slider-handle")
            ->setAttr("aria-labelledby", $label->getId())
            ->setAttr("tabindex", 0)
            ->setAttr("role", "slider");
    $this->getSlider()["segment"] = (new Span())
            ->addCssClass("range-slider-active-segment");
    $this->getSlider()["input"] = new HiddenInput();
    $this->setAttrRequired("data-sphp-slider")
            ->setStepLength($step)
            ->setValue($value)
            ->setRange($start, $end);
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
   * @return Div the actual Foundation slider
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
    return $this->getSlider()["input"];
  }

  /**
   * Sets the value of the option
   * 
   * @param  string $name the name of the option
   * @param  scalar $value the value of the option
   * @return self for PHP Method Chaining
   */
  public function setOption($name, $value) {
    $this->options[$name] = $value;
    $this->saveOptions();
    return $this;
  }

  /**
   * Returns the value of the option or null if the option is not set
   * 
   * @param  string $name the name of the option
   * @return scalar the value of the option
   */
  public function getOption($name) {
    if ($this->hasOption($name)) {
      return $this->options[$name];
    } else {
      return null;
    }
  }

  /**
   * Removes the option name value pair if the pair exists
   * 
   * @param  string $name the name of the option
   * @return self for PHP Method Chaining
   */
  public function removeOption($name) {
    if ($this->hasOption($name)) {
      unset($this->options[$name]);
      $this->saveOptions();
    }
    return $this;
  }

  /**
   * Checks whether the option is set or not
   * 
   * @param  string $name the name of the option
   * @return boolena true if the option is set, and false otherwise
   */
  public function hasOption($name) {
    return array_key_exists($name, $this->options);
  }

  /**
   * Saves the options to the html attribute
   * 
   * @return self for PHP Method Chaining
   */
  private function saveOptions() {
    $this->getSlider()->setAttr("data-options", Arrays::implodeWithKeys($this->options, ";", ": "));
    return $this;
  }

  /**
   * Sets the slider orientation to vertical
   * 
   * @return self for PHP Method Chaining
   */
  public function setVertical() {
    $this->getSlider()->addCssClass("vertical-range");
    $this->setOption("vertical", "true");
    return $this;
  }

  /**
   * Sets the slider orientation to horizontal
   * 
   * @return self for PHP Method Chaining
   */
  public function setHorizontal() {
    $this->getSlider()->removeCssClass("vertical-range");
    $this->removeOption("vertical");
    return $this;
  }

  /**
   * Sets the length of the slider step
   *
   * @param  int $step the length of the slider step
   * @return self for PHP Method Chaining
   */
  public function setStepLength($step = 1) {
    if ($step > 0) {
      $this->setOption("step", $step);
    }
    return $this;
  }

  /**
   * Sets the range of the values on the slider
   *
   * @param  int $start the start point
   * @param  int $end the end point
   * @return self for PHP Method Chaining
   * @throws \InvalidArgumentException if $start > $end
   */
  public function setRange($start = 0, $end = 100) {
    if ($start <= $end) {
      $this->setOption(self::START, $start);
      $this->setOption(self::END, $end);
      if ($this->getOption(self::START) > $this->getValue()) {
        $this->setValue($this->getOption(self::START));
      }
      if ($this->getValue() > $this->getOption(self::END)) {
        $this->setValue($this->getOption(self::END));
      }
      $this->saveOptions();
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
   * Activates the range slider component
   *
   * @param  boolean $enabled true if the component is enabled, otherwise false
   * @return self for PHP Method Chaining
   */
  public function disable($enabled = true) {
    if ($enabled) {
      $this->getSlider()->removeCssClass("disabled");
    } else {
      $this->getSlider()->addCssClass("disabled");
    }
    $this->getInput()->disable($enabled);
    return $this;
  }

  /**
   * Checks whether the option is enabled or not
   * 
   * @param  boolean true if the option is enabled, otherwise false
   */
  public function isEnabled() {
    return !$this->getInput()->attrExists("disabled");
  }

  /**
   * Returns the value of name attribute
   *
   * @return string the value of the name attribute
   * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
   */
  public function getName() {
    return $this->getInput()->getName();
  }

  /**
   * Sets the name of the input component
   *
   * @param  string $name name attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
   */
  public function setName($name) {
    $this->getInput()->setName($name);
    return $this;
  }

  /**
   * Checks whether the input component has name or not
   *
   * **Note:** Only form elements with a name attribute will have their values passed when submitting a form.
   *
   * @return boolean true if the input has a name , otherwise false
   */
  public function isNamed() {
    return $this->getInput()->isNamed();
  }

  /**
   * Returns the value of the value attribute
   *
   * @return int the value of the value attribute
   * @link   http://www.w3schools.com/tags/att_input_value.asp value attribute
   */
  public function getValue() {
    return $this->getInput()->getValue();
  }

  /**
   * Sets the value of the value attribute
   *
   * @param  int $value the value of the value attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_input_value.asp value attribute
   */
  public function setValue($value) {
    $this->getInput()->setValue($value);
    if ($this->options["start"] > $value) {
      $this->getInput()->setValue($this->options["start"]);
    } else if ($value > $this->options["end"]) {
      $this->getInput()->setValue($this->options["end"]);
    } else {
      
    }
    //$this->viewer[0] = $this->getValue();
    $this->getInnerLabel()["value"]->replaceContent($value);
    $this->getSlider()->setAttr("data-slider", $this->getValue());
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
