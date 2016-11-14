<?php

/**
 * UserInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db\Objects;

use Sphp\Net\Password;
use Sphp\Net\HashedPassword;
use Sphp\Core\Types\BitMask;

/**
 * Defines properties for a user
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-10
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface UserInterface extends DbObjectInterface {

  /**
   * Returns the username
   *
   * @return string the username
   */
  public function getUsername();

  /**
   * Sets the username
   *
   * @param  string $username the username
   * @return self for PHP Method Chaining
   */
  public function setUsername($username);

  /**
   * Returns the email address
   *
   * @return string the email address
   */
  public function getEmail();

  /**
   * Sets the email address
   *
   * @param  string $email the email address
   * @return self for PHP Method Chaining
   */
  public function setEmail($email);

  /**
   * Returns the permissions of the user
   *
   * @return BitMask the permissions of the user
   */
  public function getPermissions();

  /**
   * Sets the permissions of the user
   *
   * @param  null|scalar|BitMask $permissions the permissions of the user
   * @return self for PHP Method Chaining
   */
  public function setPermissions($permissions);

  /**
   * Returns the hashed password of the user
   *
   * @return HashedPassword the hashed password of the user
   */
  public function getPassword();

  /**
   * Sets the hashed password of the user
   *
   * @param  null|string|Password|HashedPassword $password the password of the user
   * @return self for PHP Method Chaining
   */
  public function setPassword($password = "");
}
