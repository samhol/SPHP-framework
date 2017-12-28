<?php

/**
 * PatternValidableInput.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * Defines required operations for a pattern validable input components
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface PatternValidableInput extends ValidableInput {

  /**
   * Sets the regular expression pattern that the component's value is checked against
   *
   * **Note:** The pattern attribute works with the following input types: text, search, url, tel, email, and password.
   * 
   * @param  string $pattern a regular expression pattern
   * @return $this for a fluent interface
   */
  public function setPattern(string $pattern);

  /**
   * Returns the validation pattern string
   *
   * @return string the regular expression pattern that the component's 
   *         value is checked against
   * @link   http://www.w3schools.com/tags/att_input_pattern.asp pattern attribute
   */
  public function getPattern();

  /**
   * Checks if validation pattern is set for the component
   *
   * @return boolean true if a value validation pattern is set for the 
   *         component, otherwise false
   * @link   http://www.w3schools.com/tags/att_input_pattern.asp pattern attribute
   */
  public function hasPattern(): bool;
}

