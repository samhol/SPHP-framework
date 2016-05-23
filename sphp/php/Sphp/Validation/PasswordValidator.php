<?php

/**
 * PasswordValidator.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Validation;

use Sphp\Gettext\Message as Message;

/**
 * Class validates a password
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-14
 * @version 2.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class PasswordValidator extends AbstractValidatorAggregate {

	/**
	 * Constructs a new {@link self} validator
	 */
	public function __construct() {
		parent::__construct();
		$this->set("length", new StringLengthValidator(6, 20))
				->set("numbers", new PatternValidator("/[0-9]{2,}/", 
						new Message("Please insert atleast %s numbers", ["two"])))
				->set("alphabets", new PatternValidator("/[a-zA-ZäöåÄÖÅ]{2,}/", 
						new Message("Please insert atleast %s alphabets", ["two"])))
				->set("characters", new PatternValidator("/[-_@*#]{1,}/", 
						new Message("Please insert atleast %s of the following characters (%s)", ["one", "-_@*#"])));
	}

}
