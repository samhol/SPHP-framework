<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Buttons;

use Sphp\Html\Forms\Inputs\Input;

/**
 * Implements &lt;button type="submit" tag
 *
 * A submit button is used to send form data to a server.
 * The data is sent to the page specified in the action attribute of the form.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_input.asp w3schools API
 * @link    https://www.w3.org/html/wg/drafts/html/master/forms.html#the-input-element W3C API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class SubmitButton extends AbstractButton implements Submitter, Input {

  /**
   * Constructor
   *
   * @param  string|null $content the content of the button
   * @param  string|null $name the value of name attribute
   * @param  string|int|float|null $value the value of value attribute
   * @link   https://www.w3schools.com/tags/att_button_value.asp value attribute
   * @link   https://www.w3schools.com/tags/att_button_name.asp name attribute
   */
  public function __construct(mixed $content = null, ?string $name = null, string|int|float|null $value = null) {
    parent::__construct('button', 'submit', $content);
    if (isset($name)) {
      $this->setName($name);
    }
    if (isset($value)) {
      $this->setInitialValue($value);
    }
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
