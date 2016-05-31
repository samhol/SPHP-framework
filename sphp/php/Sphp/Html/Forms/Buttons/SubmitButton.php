<?php

/**
 * SubmitButton.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Forms\Buttons;

/**
 * Class models &lt;button type="submit"&gt; tag
 *
 * A submit button is used to send form data to a server.
 * The data is sent to the page specified in the form's action attribute.
 *
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-09-26
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SubmitButton extends Button {

  /**
   * Constructs a new instance
   *
   * **Important!**
   *
   * Parameter `$content` can be of any type that converts to a
   * string or an array of strings. So also an object of any class that
   * implements magic method `__toString()` is allowed.
   *
   * @param  mixed|null $content the content of the SubmitButton
   * @param  string|null $name the value of the name attribute
   * @param  string|null $value the value of the value attribute
   * @link   http://www.w3schools.com/tags/att_button_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_button_value.asp value attribute
   */
  public function __construct($content = null, $name = null, $value = null) {
    parent::__construct("submit", $content, $name, $value);
  }

  /**
   * Specifies whether the form-data should be validated on submission or not. This attribute overrides the form's novalidate attribute.
   * 
   * @param  boolean $disabled true if the component is disabled, otherwise false
   * @return self for PHP Method Chaining
   */
  public function disableFormValidation($disabled = true) {
    return $this->setAttr("data-sphp-formnovalidate", $disabled);
  }

}
