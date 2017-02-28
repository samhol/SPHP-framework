<?php

/**
 * ValidableInputInterface.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * Defines required operations for all validable input components
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
	 * @return self for a fluent interface
	 */
	public function setRequired($required = true);

	/**
	 * Checks whether the input must have a value before form submission
	 *
	 * @return boolean true if the input must have a value before form submission, 
	 *         otherwise false
	 */
	public function isRequired();
}
