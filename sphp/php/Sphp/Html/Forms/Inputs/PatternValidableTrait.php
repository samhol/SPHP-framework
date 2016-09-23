<?php

/**
 * PatternValidableTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\Attributes\AttributeManager;

/**
 * A trait implementation of the {@link PatternValidableInputInterface} 
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-26
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait PatternValidableTrait {

  /**
   * Returns the attribute manager attached to the component
   * 
   * @return AttributeManager the attribute manager
   */
  abstract public function attrs();

  /**
   * Sets the autocomplete attribute's value on or off
   *
   * **Note:** The pattern attribute works with the following input types: text, search, url, tel, email, and password.
   * 
   * **Tip:** Use the global title attribute to describe the pattern to help the user.
   *
   * @param  string $pattern a regular expression pattern that the component's value is checked against
   * @return PatternValidableInputInterface for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_input_pattern.asp pattern attribute
   */ 
  public function setPattern($pattern) {
    $this->attrs()->set("pattern", $pattern);
    return $this;
  }

  /**
   * Returns the validation pattern string
   *
   * @return string the regular expression pattern that the component's value is checked against
   * @link   http://www.w3schools.com/tags/att_input_pattern.asp pattern attribute
   */
  public function getPattern() {
    return $this->attrs()->get("pattern");
  }

  /**
   * Checks if a value validation pattern is set fot the component
   *
   * @return boolean true if a value validation pattern is set fot the component, othewise false
   * @link   http://www.w3schools.com/tags/att_input_pattern.asp pattern attribute
   */
  public function hasPattern() {
    return $this->attrs()->exists("pattern");
  }

}
