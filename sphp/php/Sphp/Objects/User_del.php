<?php

/**
 * User.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Objects;

use Sphp\Core\Types\Arrays as Arrays;
use Sphp\Util\Permissions as Permissions;
use Sphp\Net\Password as Password;
use Sphp\Net\HashedPassword as HashedPassword;

/**
 * Class Models a system user
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2007-04-10
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class User extends AbstractDbObject {

  use ToArrayTrait;

  /**
   *
   * @var int 
   */
  private $uid;

  /**
   *
   * @var string
   */
  private $username, $fname, $lname;

  /**
   *
   * @var ContactInformation 
   */
  private $contactInformation;

  /**
   * 
   * @var Permissions 
   */
  private $permissions;

  /**
   *
   * @var HashedPassword 
   */
  private $password;

  /**
   * Returns the username
   *
   * @return string the username
   */
  public function getUsername() {
    return $this->username;
  }

  /**
   * Sets the username
   *
   * @param  string $username the username
   * @return self for PHP Method Chaining
   */
  public function setUsername($username) {
    $this->username = $username;
    return $this;
  }

  /**
   * Returns the first name
   *
   * @return string the first name
   */
  public function getFname() {
    return $this->fname;
  }

  /**
   * Sets the first name
   *
   * @param  string $fname the first name
   * @return self for PHP Method Chaining
   */
  public function setFname($fname) {
    $this->fname = $fname;
    return $this;
  }

  /**
   * Returns the last (family) name
   *
   * @return string the last (family) name
   */
  public function getLname() {
    return $this->lname;
  }

  /**
   * Sets the last (family) name
   *
   * @param  string $lname the last (family) name
   * @return self for PHP Method Chaining
   */
  public function setLname($lname) {
    $this->lname = $lname;
    return $this;
  }

  /**
   * 
   * @return Address
   */
  public function getAddress() {
    return $this->address;
  }

  /**
   * 
   * @param  Address $address
   * @return self for PHP Method Chaining
   */
  public function setAddress(Address $address = null) {
    if ($address === null) {
      $address = new Address();
    }
    $this->address = $address;
    return $this;
  }

  /**
   * Returns the permissions of the user
   *
   * @return BitMask the permissions of the user
   */
  public function getPermissions() {
    return $this->permissions;
  }

  /**
   * Sets the permissions of the user
   *
   * @param  null|scalar|BitMask $permissions the permissions of the user
   * @return self for PHP Method Chaining
   */
  public function setPermissions($permissions = 0) {
    $this->permissions = $permissions;
    return $this;
  }

  /**
   * Returns the hashed password of the user
   *
   * @return HashedPassword the hashed password of the user
   */
  public function getPassword() {
    return $this->password;
  }

  /**
   * Sets the hashed password of the user
   *
   * @param  null|string|Password|HashedPassword $password the password of the user
   * @return self for PHP Method Chaining
   */
  public function setPassword($password = "") {
    $this->password = new HashedPassword($password);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function fromArray(array $data = []) {

    $this->setPrimaryKey(Arrays::getValue($data, "uid"))
            ->setUsername(Arrays::getValue($data, "username"))
            ->setFname(Arrays::getValue($data, "fname"))
            ->setLname(Arrays::getValue($data, "lname"))
            ->setContactInformation(new ContactInformation($data))
            ->setPermissions(Arrays::getValue($data, "permissions"))
            ->setPassword(Arrays::getValue($data, "passworn"));
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function __toString() {
    
  }

  /**
   * {@inheritdoc}
   */
  public function getPrimaryKey() {
    return ["uid" => $this->uid];
  }

  /**
   * {@inheritdoc}
   */
  public function setPrimaryKey($uid) {
    $this->uid = $uid;
    return $this;
  }

  /**
   * 
   * @return mixed[]

    public function toArray() {
    $raw = get_object_vars($this);
    $result = [];
    foreach ($raw as $prop => $val) {
    if ($prop == "contactInformation") {
    $contacts = $val->toArray();
    $result = array_merge($result, $contacts);
    } else {
    $result[$prop] = $val;
    }
    }
    return $result;
    } */
}
