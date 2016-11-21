<?php

/**
 * UserValidator.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Validators;

/**
 * Class defines the business rules for a valid user
 *
 * **Conditions:**
 * 
 * 1. User::USERNAME: is given, unique and valid
 * 2. User::FNAME and User::LNAME: pair is given
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-14
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class LoginFormValidator extends FormValidator {

  /**
   * Constructs a new validator
   */
  public function __construct() {
    parent::__construct();
    $this->set('username', new RequiredValueValidator())
            ->set('password', new RequiredValueValidator());
  }

}
