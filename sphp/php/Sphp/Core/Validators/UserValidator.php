<?php

/**
 * UserValidator.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Validators;

use Sphp\Db\User;

/**
 * Class defines the business rules for a valid user
 *
 * **Conditions:**
 * 
 * 1. User::USERNAME: is given, unique and valid
 * 2. User::FNAME and User::LNAME: pair is given
 * 3. User::EMAIL: is required
 * 4. users address:
 *    1. is valid Address object
 *    2. Address::CITY is given
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-14
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class UserValidator extends AbstractObjectValidator {

  /**
   * Constructs a new {@link self} validator
   */
  public function __construct() {
    parent::__construct();
    $this->set("username", (new UserNameValidator())->allowEmptyValues(false))
            ->set("fname", new RequiredValueValidator())->set("lname", new RequiredValueValidator())
            ->set("phone", new PatternValidator("/^\+?[0-9]\ {*}$/", "Phonenumber contains only an optional + sign, numbers and spaces"))
            ->set("email", new EmailValidator())
            ->set("city", new RequiredValueValidator())
            ->set("street", (new StringLengthValidator(2, 50))->allowEmptyValues(true));
  }

  public function validate($data) {
    if ($data instanceof User) {
      $data = $data->toArray();
    }
    parent::validate($data);
    return $this;
  }

}
