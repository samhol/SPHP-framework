<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Forms\Inputs\Choicebox;
use Sphp\Html\Forms\Label;
use Sphp\Html\Span;
use Sphp\Html\Foundation\Sites\Core\ScreenReaderLabelable;
use Sphp\Html\Forms\Inputs\BooleanInput;
use Sphp\Html\Foundation\Foundation;

/**
 * Implements an abstract foundation based switch
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/switch.html Foundation Sliders
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class AbstractSwitch extends AbstractComponent implements BooleanInput, ScreenReaderLabelable {

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
   * @var string
   */
  private $screenReaderLabel, $inactive, $active;

  /**
   * Constructor
   *
   * @param Choicebox $box the inner form component
   * @param string|null $srText text for screen readers
   */
  public function __construct(Choicebox $box, string $srText = null) {
    $box->cssClasses()->protectValue('switch-input');
    parent::__construct('div');
    $this->input = $box;
    $this->cssClasses()
            ->protectValue('switch');
    $box->identify();
    $this->setScreenReaderLabel($srText);
  }

  /**
   * Creates paddle component for switch
   * 
   * @return Label paddle component for switch
   */
  protected function createPaddle(): Label {
    $paddle = new Label();
    $paddle->setFor($this->input);
    $paddle->cssClasses()
            ->protectValue('switch-paddle');
    if ($this->screenReaderLabel !== null) {
      $paddle->append(Foundation::screenReaderLabel($this->screenReaderLabel));
    }
    if ($this->active !== null || $this->inactive !== null) {
      $activeLabel = new Span($this->active);
      $activeLabel->attributes()
              ->protect('aria-hidden', 'true')
              ->classes()->protectValue('switch-active');
      $paddle->append($activeLabel);
      $inactiveLabel = new Span($this->inactive);
      $inactiveLabel->attributes()
              ->protect('aria-hidden', 'true')
              ->classes()->protectValue('switch-inactive');
      $paddle->append($inactiveLabel);
    }
    return $paddle;
  }

  public function setScreenReaderLabel(string $label = null) {
    $this->screenReaderLabel = $label;
    return $this;
  }

  public function getScreenReaderLabel(): ?string {
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
      $this->addCssClass($size);
    }
    return $this;
  }

  /**
   * Resets the size settings of the component
   *
   * @return $this for a fluent interface
   */
  public function resetSize() {
    $this->removeCssClass(self::$sizes);
    return $this;
  }

  /**
   * Sets the active and inactive text inside of a switch
   *
   * @param  string $active the active text inside of a switch
   * @param  string $inactive the inactive text inside of a switch
   * @return $this for a fluent interface
   */
  public function setInnerLabels(string $active = null, string $inactive = null) {
    $this->active = $active;
    $this->inactive = $inactive;
    return $this;
  }

  public function getInput(): Choicebox {
    return $this->input;
  }

  public function disable(bool $disabled = true) {
    $this->input->disable($disabled);
    return $this;
  }

  public function isEnabled(): bool {
    return $this->input->isEnabled();
  }

  public function getName(): ?string {
    return $this->input->getName();
  }

  public function setName(string $name = null) {
    $this->input->setName($name);
    return $this;
  }

  public function isNamed(): bool {
    return $this->input->isNamed();
  }

  public function setInitialValue($value) {
    $this->input->setInitialValue($value);
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
    return $this->input->getHtml() . $this->createPaddle()->getHtml();
  }

  public function getSubmitValue() {
    $this->input->getSubmitValue();
  }

  public function setChecked(bool $checked = true) {
    $this->input->setChecked($checked);
    return $this;
  }

}
