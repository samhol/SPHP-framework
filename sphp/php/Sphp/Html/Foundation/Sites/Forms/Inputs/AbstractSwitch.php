<?php

/**
 * AbstractSwitch.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Forms\Inputs\Choicebox;
use Sphp\Html\Forms\Label;
use Sphp\Html\Span;
use Sphp\Html\Foundation\Sites\Core\ScreenReaderLabel;
use Sphp\Html\Foundation\Sites\Core\ScreenReaderLabelable;
use Sphp\Html\Forms\Inputs\ChoiceboxInterface;

/**
 * Implements an abstract foundation based switch
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/switch.html Foundation Sliders
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class AbstractSwitch extends AbstractComponent implements ChoiceboxInterface, ScreenReaderLabelable {

  /**
   * CSS classes corresponding to the size constants
   *
   * @var string[]
   */
  private static $sizes = [
      'tiny', 'small', 'large'
  ];

  /**
   * @var Choicebox 
   */
  private $input;

  /**
   * @var Label 
   */
  private $paddle;

  /**
   * @var ScreenReaderLabel
   */
  private $screenReaderLabel;

  /**
   * Constructs a new instance
   *
   * @param Choicebox $box the inner form component
   * @param string|null $srText text for screen readers
   */
  public function __construct(Choicebox $box, $srText = "") {
    $box->cssClasses()->lock('switch-input');
    parent::__construct('div');
    $this->input = $box;
    $this->cssClasses()
            ->lock('switch');
    $box->identify();
    $this->screenReaderLabel = new ScreenReaderLabel($srText);
    $this->paddle = new Label(null, $this->input);
    $this->paddle->offsetSet('screenReaderLabel', $this->screenReaderLabel);
    $this->paddle->cssClasses()
            ->lock('switch-paddle');
  }

  public function setScreenReaderLabel($label) {
    if ($label instanceof ScreenReaderLabel) {
      $this->screenReaderLabel = $label;
    } else {
      $this->getScreeReaderLabel()->replaceContent($label);
    }
    return $this;
  }

  public function getScreeReaderLabel() {
    if (!($this->screenReaderLabel instanceof ScreenReaderLabel)) {
      $this->screenReaderLabel = new ScreenReaderLabel();
    }
    return $this->screenReaderLabel;
  }

  /**
   * Sets the size of the component
   *
   * **Available size options:**
   * 
   * * `'tiny'` for tiny switches
   * * `'small'` for small switches
   * * `'default'` for default sized switches
   * * `'large'` for large switches
   * 
   * @param  string $size the size of the component
   * @return $this for a fluent interface
   */
  public function setSize($size) {
    $this->resetSize();
    if (in_array($size, self::$sizes)) {
      $this->cssClasses()->add($size);
    }
    return $this;
  }

  /**
   * Resets the size settings of the component
   *
   * @return $this for a fluent interface
   */
  public function resetSize() {
    $this->cssClasses()
            ->remove(self::$sizes);
    return $this;
  }

  /**
   * Sets the active and inactive text inside of a switch
   *
   * @param  string $active the active text inside of a switch
   * @param  string $inactive the inactive text inside of a switch
   * @return $this for a fluent interface
   */
  public function setInnerLabels($active, $inactive) {
    $activeLabel = new Span($active);
    $activeLabel->attrs()
            ->lock('aria-hidden', 'true')
            ->classes()->lock('switch-active');
    $inactiveLabel = new Span($inactive);
    $inactiveLabel->attrs()
            ->lock('aria-hidden', 'true')
            ->classes()->lock('switch-inactive');
    $this->paddle->offsetSet('switch-active', $activeLabel);
    $this->paddle->offsetSet('switch-inactive', $inactiveLabel);
    return $this;
  }

  public function disable(bool $disabled = true) {
    $this->input->disable($disabled);
    return $this;
  }

  public function isEnabled(): bool {
    return $this->input->isEnabled();
  }

  public function getName() {
    return $this->input->getName();
  }

  public function setName(string $name) {
    $this->input->setName($name);
    return $this;
  }

  public function isNamed(): bool {
    return $this->input->isNamed();
  }

  public function setValue($value) {
    $this->input->setValue($value);
    return $this;
  }

  /**
   * Sets whether the input must have a value or not before form submission
   * 
   * @param  boolean $required true if the input must have a value before form submission, otherwise false
   * @return $this for a fluent interface
   */
  public function setRequired(bool $required = true) {
    $this->input->setRequired($required);
    return $this;
  }

  /**
   * Checks whether the input must have a value before form submission
   *
   * @return boolean true if the input must have a value before form submission, false otherwise
   */
  public function isRequired(): bool {
    return $this->input->isRequired();
  }

  public function createLabel($content = null) {
    $label = new Label($content, $this->input);
    return $label;
  }

  public function contentToString(): string {
    return $this->input->getHtml() . $this->paddle->getHtml();
  }

  public function getSubmitValue() {
    $this->input->getSubmitValue();
  }

  public function setChecked(bool $checked = true) {
    $this->input->setChecked($checked);
    return $this;
  }

}
