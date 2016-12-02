<?php

/**
 * PatternValidableInputInterface.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * Defines required operations for a pattern validable input components
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-02-15
 * @link    http://foundation.zurb.com/ Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface PatternValidableInputInterface extends ValidableInputInterface {

	/**
	 * Sets the regular expression pattern that the component's value is checked against
	 *
	 * **Note:** The pattern attribute works with the following input types: text, search, url, tel, email, and password.
	 * 
	 * @param  string $pattern a regular expression pattern
	 * @return self for PHP Method Chaining
	 */
	public function setPattern($pattern);

	/**
	 * Returns the validation pattern string
	 *
	 * @return string the regular expression pattern that the component's 
	 *         value is checked against
	 * @link   http://www.w3schools.com/tags/att_input_pattern.asp pattern attribute
	 */
	public function getPattern();

	/**
	 * Checks if a value validation pattern is set for the component
	 *
	 * @return boolean true if a value validation pattern is set fot the 
	 *         component, othewise false
	 * @link   http://www.w3schools.com/tags/att_input_pattern.asp pattern attribute
	 */
	public function hasPattern();
}
