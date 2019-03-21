<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Forms\Inputs\ValidableInput;

/**
 * Description of ValidableInputContainerTrait
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
trait ValidableInputContainerTrait {

  /**
   * Returns the actual input component
   * 
   * @return ValidableInput actual input component
   */
  abstract public function getInput(): ValidableInput;

  /**
   * Disables the controller
   * 
   * A disabled form controller is unusable and un-clickable. 
   * Disabled input in a form will not be submitted.
   *
   * @param  boolean $disabled true for disabled, otherwise false
   * @return $this for a fluent interface
   */
  public function disable(bool $disabled = true) {
    $this->getInput()->disable($disabled);
    return $this;
  }

  /**
   * Returns the name of the form input
   *
   * @return string|null the name of the form input
   */
  public function getName(): ?string {
    return $this->getInput()->getName();
  }

  /**
   * Returns the value of the form input
   *
   * @return mixed the value
   */
  public function getSubmitValue() {
    return $this->getInput()->getSubmitValue();
  }

  /**
   * Checks whether the controller is enabled or not
   * 
   * @return bool true if enabled, otherwise false
   */
  public function isEnabled(): bool {
    return $this->getInput()->isEnabled();
  }

  /**
   * Checks whether the form input has a name
   *
   * **Note:** Only form elements with a name attribute will have their values 
   * passed when submitting a form.
   *
   * @return bool true if the input has a name, otherwise false
   */
  public function isNamed(): bool {
    return $this->getInput()->isNamed();
  }

  /**
   * Checks whether the input must have a value before form submission
   *
   * @return bool true if the input must have a value before form submission, 
   *         otherwise false
   */
  public function isRequired(): bool {
    return $this->getInput()->isRequired();
  }

  /**
   * Sets the initial submit value of the input
   *
   * @param  mixed $value the value of the input
   * @return $this for a fluent interface
   * @throws InvalidStateException if value is not suitable for input
   */
  public function setInitialValue($value) {
    $this->getInput()->setInitialValue($value);
    return $this;
  }

  /**
   * Sets the name of the input
   *
   * **Note:** Only form elements with a name attribute will have their values 
   * passed when submitting a form.
   *
   * @param  string $name the name of the input
   * @return $this for a fluent interface
   */
  public function setName(string $name = null) {
    $this->getInput()->setName($name);
    return $this;
  }

  /**
   * Sets whether the input must have a value or not before form submission
   * 
   * @param  bool $required true if the input must have a value before form 
   *         submission, otherwise false
   * @return $this for a fluent interface
   */
  public function setRequired(bool $required = true) {
    $this->getInput()->setRequired($required);
    return $this;
  }

}
