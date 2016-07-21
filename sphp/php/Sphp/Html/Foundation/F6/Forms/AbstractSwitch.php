<?php

/**
 * AbstractSwitch.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Forms;

use Sphp\Html\AbstractComponent as AbstractComponent;
use Sphp\Html\Forms\LabelableInterface as LabelableInputInterface;
use Sphp\Html\Forms\Inputs\Choicebox as Choicebox;
use Sphp\Html\Forms\Label as Label;
use Sphp\Html\Span as Span;

/**
 * Class implements an abstract foundation based switch
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-05-17
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/sites/docs/slider.html Foundation 6 Sliders
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractSwitch extends AbstractComponent implements LabelableInputInterface {

  /**
   *
   * @var Choicebox 
   */
  private $input;

  /**
   *
   * @var Label 
   */
  private $paddle;

  /**
   *
   * @var Span
   */
  private $screenReaderInfo;

  /**
   * Constructs a new instance
   *
   * @param Choicebox $box the inner form component
   * @param string|null $srText text for screen readers
   */
  public function __construct(Choicebox $box, $srText = null) {
    $box->cssClasses()->lock("switch-input");
    parent::__construct("div");
    $this->input = $box;
    $this->cssClasses()->lock("switch");
    $box->identify();
    $screenReaderInfo = new Span($srText);
    $screenReaderInfo->cssClasses()
            ->lock("show-for-sr");
    $handle = new Label($screenReaderInfo, $box);
    $handle->cssClasses()->lock("switch-paddle");
    $this->paddle = $handle;
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
    $this->paddle->set("switch-active", $activeLabel);
    $this->paddle->set("switch-inactive", $inactiveLabel);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function disable($disabled = true) {
    $this->input->disable($disabled);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isEnabled() {
    return $this->input->isEnabled();
  }

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->input->getName();
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->input->setName($name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isNamed() {
    return $this->input->isNamed();
  }

  /**
   * {@inheritdoc}
   */
  public function getValue() {
    return $this->input->getValue();
  }

  /**
   * {@inheritdoc}
   */
  public function setValue($value) {
    $this->input->setValue($value);
    return $this;
  }

  /**
   * Sets whether the input must have a value or not before form submission
   * 
   * @param  boolean $required true if the input must have a value before form submission, otherwise false
   * @return self for PHP Method Chaining
   */
  public function setRequired($required = true) {
    $this->input->setRequired($required);
    return $this;
  }

  /**
   * Checks whether the input must have a value before form submission
   *
   * @return boolean true if the input must have a value before form submission, false otherwise
   */
  public function isRequired() {
    return $this->input->isRequired();
  }

  /**
   * {@inheritdoc}
   */
  public function createLabel($label = null) {
    $this->input->createLabel($label);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function contentToString() {
    return $this->input . $this->paddle;
  }

}
