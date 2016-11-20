<?php

/**
 * UserNameValidator.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Validators;

use Sphp\Db\Objects\User as User;
use Sphp\Core\Types\Strings;

/**
 * Class validates a username
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-14
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
    $username = (string) $value;
    /*if (!Strings::lengthBetween($username, 6, 12)) {
      $this->createErrorMessage("Please insert %d-%d characters", [6, 12]);
    }*/
    if (!Strings::match($username, "/^([a-zA-Z0-9]){6,255}$/")) {
      $this->createErrorMessage("Please insert 6-255 alphabets and numbers only");
    }
    /* if (!$user->isUnique()) {
      $this->createErrorMessage("Username is already reserved");
      } */
  }

}
