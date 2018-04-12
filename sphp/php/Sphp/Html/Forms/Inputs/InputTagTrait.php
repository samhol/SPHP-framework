<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * Trait implements the {@link Input} for input tags
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 * @link Input
 */
trait InputTagTrait {

  /**
   * Returns the value of the name attribute.
   *
   * @return string name attribute
   */
  public function getName(): string {
    return (string) $this->attributes()->getValue('name');
  }

  /**
   * Sets the value of the name attribute
   *
   * @param  string $name the value of the name attribute
   * @return $this for a fluent interface
   */
  public function setName(string $name) {
    $this->attributes()->set('name', $name);
    return $this;
  }

  /**
   * Checks whether the form input has a name
   *
   * **Note:** Only form elements with a name attribute will have their values 
   * passed when submitting a form.
   *
   * @return boolean true if the input has a name, otherwise false
   */
  public function isNamed(): bool {
    return $this->attributes()->exists('name');
  }

  /**
   * Disables the input component
   * 
   * A disabled input component is unusable and un-clickable. 
   * Disabled input components in a form will not be submitted.
   *
   * @param  boolean $disabled true if the component is disabled, otherwise false
   * @return $this for a fluent interface
   */
  public function disable(bool $disabled = true) {
    $this->attributes()->setBoolean('disabled', $disabled);
    return $this;
  }

  /**
   * Checks whether the input component is enabled or not
   * 
   * @return boolean true if the input component is enabled, otherwise false
   */
  public function isEnabled(): bool {
    return !$this->attributes()->exists('disabled');
  }

  /**
   * Returns the type attribute value
   *
   * @return string the type attribute value
   * @link   http://www.w3schools.com/tags/att_input_type.asp type attribute
   */
  public function getType(): string {
    return (string) $this->attributes()->getValue('type');
  }

  /**
   * Returns the value of the value attribute.
   *
   * @return string the value of the value attribute
   * @link   http://www.w3schools.com/tags/att_input_value.asp value attribute
   */
  public function getSubmitValue() {
    return $this->attributes()->getValue('value');
  }

  /**
   * Sets the value of the value attribute.
   *
   * @param  scalar|null $value the value of the value attribute
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_input_value.asp value attribute
   */
  public function setSubmitValue($value) {
    $this->attributes()->set('value', $value);
    return $this;
  }

}
