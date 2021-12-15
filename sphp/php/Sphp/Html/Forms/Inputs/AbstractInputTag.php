<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\EmptyTag;

/**
 * Class is the abstract base class for all &lt;input&gt; tag implementations
 *
 * This component specifies an HTML input field 
 * where the user can enter data. These components are used within a 
 * {@link \Sphp\Html\Forms\FormInterface} component to declare input controls 
 * that allow users to input data. 
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_input.asp w3schools HTML
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractInputTag extends EmptyTag implements Input {

  /**
   * Constructor
   *
   * @param  string|null $type the value of the type attribute
   * @param  string|null $name the value of the name attribute
   * @param  string|null $value the value of the value attribute
   * @link   https://www.w3schools.com/tags/att_input_type.asp type attribute
   * @link   https://www.w3schools.com/tags/att_input_name.asp name attribute
   * @link   https://www.w3schools.com/tags/att_input_value.asp value attribute
   */
  public function __construct(string $type = null, string $name = null, $value = null) {
    parent::__construct('input');
    $this->attributes()->protect('type', $type);
    $this->setName($name);
    $this->setInitialValue($value);
  }

  /**
   * Returns the value of the name attribute.
   *
   * @return string name attribute
   */
  public function getName(): ?string {
    return $this->attributes()->getValue('name');
  }

  /**
   * Sets the value of the name attribute
   *
   * @param  string|null $name the value of the name attribute
   * @return $this for a fluent interface
   */
  public function setName(?string $name) {
    $this->attributes()->setAttribute('name', $name);
    return $this;
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
    return $this->attributes()->isVisible('name');
  }

  /**
   * Disables the input component
   * 
   * A disabled input component is unusable and un-clickable. 
   * Disabled input components in a form will not be submitted.
   *
   * @param  bool $disabled true if the component is disabled, otherwise false
   * @return $this for a fluent interface
   */
  public function disable(bool $disabled = true) {
    $this->attributes()->setAttribute('disabled', $disabled);
    return $this;
  }

  /**
   * Checks whether the input component is enabled or not
   * 
   * @return bool true if the input component is enabled, otherwise false
   */
  public function isEnabled(): bool {
    return !$this->attributes()->isVisible('disabled');
  }

  /**
   * Returns the type attribute value
   *
   * @return string|null the type attribute value
   * @link   https://www.w3schools.com/tags/att_input_type.asp type attribute
   */
  public function getType(): ?string {
    return $this->attributes()->getValue('type');
  }

  /**
   * Returns the value of the value attribute.
   *
   * @return string the value of the value attribute
   * @link   https://www.w3schools.com/tags/att_input_value.asp value attribute
   */
  public function getSubmitValue() {
    return $this->attributes()->getValue('value');
  }

  /**
   * Sets the value of the value attribute.
   *
   * @param  scalar|null $value the value of the value attribute
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/tags/att_input_value.asp value attribute
   */
  public function setInitialValue($value) {
    $this->attributes()->setAttribute('value', $value);
    return $this;
  }

}
