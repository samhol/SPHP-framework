<?php

/**
 * ValidableInputTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * A trait implementation of the {@link ValidableInputInterface} 
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-26
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait ValidableInputTrait {

  use InputTrait;

  /**
   * Sets whether the input must have a value or not before form submission
   * 
   * @param  boolean $required true if the input must have a value before form 
   *         submission, otherwise false
   * @return self for PHP Method Chaining
   */
  public function setRequired($required = true) {
    return $this->setAttr("required", $required);
  }

  /**
   * Checks whether the input must have a value before form submission
   *
   * @return boolean true if the input must have a value before form submission, 
   *         otherwise false
   */
  public function isRequired() {
    return $this->attrExists("required");
  }

  /**
   * Sets the autocomplete attribute's value on or off
   *
   * **Note:** The pattern attribute works with the following input types: text, search, url, tel, email, and password.
   * 
   * **Tip:** Use the global title attribute to describe the pattern to help the user.
   *
   * @param  string $pattern a regular expression pattern that the component's value is checked against
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_input_pattern.asp pattern attribute
   */
  public function setPattern($pattern) {
    return $this->setAttr("data-sphp-pattern", $pattern);
  }

  /**
   * Returns the validation pattern string
   *
   * @return string the regular expression pattern that the component's value is checked against
   * @link   http://www.w3schools.com/tags/att_input_pattern.asp pattern attribute
   */
  public function getPattern() {
    return $this->getAttrValue("data-sphp-pattern");
  }

  /**
   * Checks if a value validation pattern is set fot the component
   *
   * @return boolean true if a value validation pattern is set fot the component, othewise false
   * @link   http://www.w3schools.com/tags/att_input_pattern.asp pattern attribute
   */
  public function hasPattern() {
    return $this->attrExists("data-sphp-pattern");
  }

}
