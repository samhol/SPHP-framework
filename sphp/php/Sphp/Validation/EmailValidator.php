<?php

/**
 * EmailValidator.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Validation;

/**
 * Class validates a value as an email address
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-08-14
 * @version 1.0.0
 *
 */
class EmailValidator extends AbstractOptionalValidator {

	/**
	 * Validates the value as an email address
	 *
	 * @param  string $value the value to validate
	 * @return self for PHP Method Chaining
	 */
	protected function executeValidation($value) {
		if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
			$this->createErrorMessage("Please insert a correct email address");
		}
		return $this;
	}

}