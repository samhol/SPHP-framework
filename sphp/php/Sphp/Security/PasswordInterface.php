<?php

/**
 * PasswordInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Security;

/**
 * Defines a verifiable password
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface PasswordInterface {

  /**
   * Returns the hashed password string
   * 
   * @return string the hashed password string
   */
  public function getHash(): string;

  /**
   * Verifies that a plain password matches the instance
   * 
   * @param  string|Password $password the crypted password to check against
   * @return boolean true if the password hash pair matches and false otherwise
   */
  public function verify($password): bool;
}
