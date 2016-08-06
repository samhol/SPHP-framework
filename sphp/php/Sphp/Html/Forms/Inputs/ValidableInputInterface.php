<?php

/**
 * ValidableInputInterface.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * Interface defines required operations for all validable input components used in {@link FormInterface}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-02-15
 * @link    http://foundation.zurb.com/ Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ValidableInputInterface extends InputInterface {

	/**
	 * Sets whether the input must have a value or not before form submission
	 * 
	 * @param  boolean $required true if the input must have a value before form 
	 *         submission, otherwise false
	 * @return self for PHP Method Chaining
	 */
	public function setRequired($required = true);

	/**
	 * Checks whether the input must have a value before form submission
	 *
	 * @return boolean true if the input must have a value before form submission, 
	 *         otherwise false
	 */
	public function isRequired();

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
	 * @return  string the regular expression pattern that the component's 
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
