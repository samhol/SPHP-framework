<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Db\Objects;

use Sphp\Net\Password;
use Sphp\Net\HashedPassword;

/**
 * Description of UserInterface
 *
 * @author Sami Holck
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
  public function setPermissions($permissions = 0);

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
