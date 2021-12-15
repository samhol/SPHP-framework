<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Bootstrap\Components\Forms;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Forms\Inputs\Choicebox;
use Sphp\Html\Forms\Label;
use Sphp\Html\Forms\Inputs\BooleanInput;
use Sphp\Html\Forms\Inputs\Radiobox;
use Sphp\Html\Forms\Inputs\Checkbox;

/**
 * Implements an abstract foundation based switch
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/switch.html Foundation Sliders
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class SwitchInput extends AbstractComponent implements BooleanInput {

  /**
   * CSS classes corresponding to the size constants
   *
   * @var string[]
   */
  private static array $sizes = [
      'tiny', 'small', 'large'
  ];

  /**
   * @var Choicebox 
   */
  private Choicebox $input;

  /**
   * @var Label
   */
  private Label $label;

  /**
   * Constructor
   *
   * @param Choicebox $box the inner form component
   * @param string|null $label text for screen readers
   */
  public function __construct(Choicebox $box, string $label = null) {
    $box->cssClasses()->protectValue('form-check-input');
    parent::__construct('div');
    $this->input = $box;
    $this->cssClasses()
            ->protectValue('form-check form-switch');
    $box->identify();
    $this->label = new Label($label);
    $this->label->setFor($this->input);
    $this->label->cssClasses()
            ->protectValue('form-check-label');
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
    $this->removeCssClass(...self::$sizes);
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
   * @param  bool $required true if the input must have a value before form submission, otherwise false
   * @return $this for a fluent interface
   */
  public function setRequired(bool $required = true) {
    $this->input->setRequired($required);
    return $this;
  }

  /**
   * Checks whether the input must have a value before form submission
   *
   * @return bool true if the input must have a value before form submission, false otherwise
   */
  public function isRequired(): bool {
    return $this->input->isRequired();
  }

  public function createLabel($content = null) {
    $label = new Label($content, $this->input);
    return $label;
  }

  public function contentToString(): string {
    return $this->input->getHtml() . $this->label->getHtml();
  }

  public function getSubmitValue() {
    return $this->input->getSubmitValue();
  }

  public function setChecked(bool $checked = true) {
    $this->input->setChecked($checked);
    return $this;
  }

  public function isChecked(): bool {
    return $this->input->isChecked();
  }

  public static function radio(string $name = null, $value = null, string $label = null, bool $checked = false): SwitchInput {
    $input = new SwitchInput(new Radiobox($name, $value, $checked), $label);
    return $input;
  }

  public static function checkbox(string $name = null, $value = null, string $label = null, bool $checked = false): SwitchInput {
    $input = new SwitchInput(new Checkbox($name, $value, $checked), $label);
    return $input;
  }

}
