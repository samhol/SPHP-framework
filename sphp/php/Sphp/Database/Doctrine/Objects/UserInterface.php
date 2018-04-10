<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database\Doctrine\Objects;

use Sphp\Core\Security\PasswordInterface;
use Sphp\Stdlib\BitMask;

/**
 * Defines properties for a user
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
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
   * @return $this for a fluent interface
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
   * @return $this for a fluent interface
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
   * @return $this for a fluent interface
   */
  public function setPermissions($permissions);

  /**
   * Returns the hashed password of the user
   *
   * @return PasswordInterface the hashed password of the user
   */
  public function getPassword();

  /**
   * Sets the hashed password of the user
   *
   * @param  PasswordInterface $password the password of the user
   * @return $this for a fluent interface
   */
  public function setPassword(PasswordInterface $password);
}
