<?php

/**
 * IonRangeSlider.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms;

use Sphp\Html\AbstractJavaScriptComponent as AbstractJavaScriptComponent;
use Sphp\Html\Forms\Inputs\TextInput as TextInput;
use Sphp\Html\Programming\ScriptCode as ScriptCode;
use Sphp\Core\Types\Arrays as Arrays;

/**
 * Class implements jQuery range slider with skin support
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-10-11
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class IonRangeSlider extends TextInput {

  const START = "min";
  const END = "max";
  const STEP = "step";
  const DISABLE = "disable";
  const POSTFIX = "postfix";

  /**
   * slider options
   *
   * @var scalar[] 
   */
  private $options = [];
  /* self::START => 0,
    self::STEP => 1,
    self::END => 100
    ]; */

  /**
   * the scriptcode component
   *
   * @var string[]
   */
  private $script = [];

  /**
   * Constructs a new instance of the {@link IonRangeSlider} component
   *
   * @param int $start the start value of the slider
   * @param int $end the end value of the slider
   * @param int $step the length of a single step
   * @throws \InvalidArgumentException if the $value is not between the range
   */
  public function __construct($name, $start = 0, $end = 100, $step = 1) {
    parent::__construct($name);
    $this->script = [];
    $this->identify();
    $this
            ->setRange($start, $end)
            ->setStepLength($step)
            ->setValue($start);
  }

  /**
   * Returns the inner input component
   * 
   * @return TextInput the inner input component
   */
  private function getInput() {
    return $this->content()->get("input");
  }

  /**
   * Builds the HTML structure of the component
   * 
   * @return self for PHP Method Chaining
   */
  private function build() {
    // $this->script["start"] = "$('#" . $this->getId() . "').ionRangeSlider({";
    //$this->getScript()["onChange"] = 'onChange: function(obj) {},';
    //$this->script["end"] = "});";
    return $this;
  }

  /**
   * Sets the value of the option
   * 
   * @param  string $name the name of the option
   * @param  mixed $value the value of the option
   * @return self for PHP Method Chaining
   */
  public function setOption($name, $value) {
    if (is_string($value)) {
      $xvalue = "'$value'";
    } else if (is_bool($value)) {
      $xvalue = ($value) ? "true" : "false";
    } else {
      $xvalue = $value;
    }
    $this->options[$name] = $value;
    $this->script["'" . $name . "'"] = $xvalue;
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
      unset($this->options[$name], $this->script["'" . $name . "'"]);
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
   * Sets the length of the slider step
   *
   * @param  int $step the length of the slider step
   * @return self for PHP Method Chaining
   * @throws \InvalidArgumentException if the step value is below zero
   */
  public function setStepLength($step = 1) {
    $range = $this->getOption(self::END) - $this->getOption(self::START);
    if ($step < 0) {
      throw new \InvalidArgumentException("Step value ($step) is below zero");
    }
    if ($step > $range) {
      throw new \InvalidArgumentException("Step value ($step) is bigger than range ($range)");
    }
    $this->setOption(self::STEP, $step);
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
    if ($start > $end) {
      throw new \InvalidArgumentException("Illegal value range ($start-$end)");
    }
    $this->setOption(self::START, $start);
    $this->setOption(self::END, $end);
    if ($this->getOption(self::START) > $this->getValue()) {
      $this->setValue($this->getOption(self::START));
    }
    if ($this->getValue() > $this->getOption(self::END)) {
      $this->setValue($this->getOption(self::END));
    }
    return $this;
  }

  /**
   * Sets the type of the slider 
   * 
   * About the type of the slider (<var>$type</var> attribute):
   * 
   * * `single` for one handle
   * * `double` for two handles
   * 
   * @param  string $type the type of the slider
   * @return self for PHP Method Chaining
   */
  public function setType($type) {
    $this->setOption("type", $type);
    return $this;
  }

  /**
   * Checks whether the slider has one handle or not
   * 
   * @return boolean true if the slider has one handle, false otherwise
   */
  public function isSingleSlider() {
    return !$this->hasOption("type") || $this->getOption("type") === "single";
  }

  /**
   * Checks whether the slider is range slider or not
   * 
   * @return boolean true if the slider is range slider, false otherwise
   */
  public function isRangeSlider() {
    return !$this->hasOption("type") || $this->getOption("type") === "double";
  }

  /**
   * Sets the unit of the slider value
   * 
   * @param  string $unit the unit of the value
   * @return self for PHP Method Chaining
   */
  public function setPostfix($unit = "") {
    $this->setOption("postfix", $unit);
    return $this;
  }

  /**
   * Activates the range slider component
   *
   * @param  boolean $disabled true if the component is enabled, otherwise false
   * @return self for PHP Method Chaining
   */
  public function disable($disabled = true) {
    $this->setOption("disable", $disabled);
    parent::disable($disabled);
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
   * Sets the value of the value attribute
   *
   * @param  int $from the value of the value attribute
   * @param  int $to the value of the value attribute
   * @return self for PHP Method Chaining
   * @throws \InvalidArgumentException if the $value is not between the range of the slider
   */
  public function setValue($from, $to = null) {
    if ($this->getOption(self::START) > $from || $from > $this->options[self::END]) {
      throw new \InvalidArgumentException("The value ($from) of the slider is not between ({$this->getOption(self::START)}-{$this->getOption(self::END)})");
    }
    if ($this->isRangeSlider() && $to !== null) {
      $this->setOption("to", $to);
    }
    $this->setOption("from", $from);
    parent::setValue($from);
    return $this;
  }

  public function getHtml() {
    $this->attrs()->set("data-ion-rangeslider", "{" . Arrays::implodeWithKeys($this->script, ",", ":") . "}");
    return parent::getHtml();
  }

}
