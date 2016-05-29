<?php

/**
 * UserNameValidator.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Validation;

use Sphp\Db\Objects\User as User;
use Sphp\Core\Types\Strings as Strings;

/**
 * Class validates a username
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-14
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class UserNameValidator extends AbstractOptionalValidator {

  /**
   * Validates the username
   *
   * @param  string $value the value to validate
   * @return self for PHP Method Chaining
   */
  protected function executeValidation($value) {
    if (!($value instanceof User)) {
      $user = (new User())->setUsername($value);
      $username = $value;
    } else {
      $username = $value->getUsername();
      $user = $value;
    }
    if (!Strings::lengthBetween($username, 6, 12)) {
      $this->createErrorMessage("Please insert %d-%d characters", [6, 12]);
    }
    if (!Strings::match($username, "/^([a-zA-Z0-9]){1,}$/")) {
      $this->createErrorMessage("Please insert alphabets and numbers only");
    }
    /* if (!$user->isUnique()) {
      $this->createErrorMessage("Username is already reserved");
      } */
  }

}
