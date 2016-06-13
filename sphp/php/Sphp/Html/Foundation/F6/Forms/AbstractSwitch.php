<?php

/**
 * AbstractSwitch.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Forms;

use Sphp\Html\AbstractComponent as AbstractComponent;
use Sphp\Html\Forms\LabelableInputInterface as LabelableInputInterface;
use Sphp\Html\Forms\Input\Choicebox as Choicebox;
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
class AbstractSwitch extends AbstractComponent implements LabelableInputInterface {

  /**
   * Constructs a new instance
   * <div class="switch">
    <input class="switch-input" id="exampleSwitch" type="checkbox" name="exampleSwitch">
    <label class="switch-paddle" for="exampleSwitch">
    <span class="show-for-sr">Download Kittens</span>
    <span class="switch-active" aria-hidden="true">Yes</span>
    <span class="switch-inactive" aria-hidden="true">No</span>
    </label>
    </div>
   * @param int $start the start value of the slider
   * @param int $end the end value of the slider
   * @param int $value the current value of the slider
   * @param int $step the length of a single step
   */
  public function __construct(Choicebox $box, $srText = null) {
    $box->cssClasses()->lock("switch-input");
    parent::__construct("div");
    $this->content()["input"] = $box;
    $this->cssClasses()->lock("switch");
    $box->identify();
    $screenReaderInfo = new Span($srText);
    $screenReaderInfo->cssClasses()
            ->lock("show-for-sr");
    $handle = new Label($screenReaderInfo, $box);
    $handle->cssClasses()->lock("switch-paddle");
    $this->content()["switch-paddle"] = $handle;
  }

  /**
   * Returns the label of the slider
   * 
   * @return Label the label describing the slider
   */
  private function getInnerLabel() {
    return $this->content()["switch-paddle"];
  }

  /**
   * Returns the actual (hidden) form element containg the value of the slider
   * 
   * @return Choicebox the actual (hidden) form element containg the value of the slider
   */
  private function getInput() {
    return $this->content("input");
  }

  /**
   * Sets the active and inactive text inside of a switch
   * 
   * @param  string $active
   * @param  string $inactive
   * @return self for PHP Method Chaining
   */
  public function setInnerLabels($active, $inactive) {
    $activeLabel = new Span($active);
    $activeLabel->attrs()
            ->lock("aria-hidden", "true")
            ->classes()->lock("switch-active");
    $inactiveLabel = new Span($inactive);
    $inactiveLabel->attrs()
            ->lock("aria-hidden", "true")
            ->classes()->lock("switch-inactive");
    $this->getInnerLabel()->set("switch-active", $activeLabel);
    $this->getInnerLabel()->set("switch-inactive", $inactiveLabel);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function disable($disabled = true) {
    $this->getInput()->disable($disabled);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isEnabled() {
    return $this->getInput()->isEnabled();
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
     $this->getInput()->setRequired($required);
     return $this;
  }

  /**
   * Checks whether the input must have a value before form submission
   *
   * @return boolean true if the input must have a value before form submission, false otherwise
   */
  public function isRequired() {
    return $this->getInput()->isRequired();
  }

  /**
   * {@inheritdoc}
   */
  public function getLabel() {
    return $this->getInput()->getLabel();
  }

  /**
   * {@inheritdoc}
   */
  public function hasLabel() {
    return $this->getInput()->hasLabel();
  }

  /**
   * {@inheritdoc}
   */
  public function setLabel($label) {
    $this->getInput()->setLabel($label);
    return $this;
  }

}
