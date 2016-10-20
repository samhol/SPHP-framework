<?php

/**
 * Password.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Net;

use Sphp\Objects\ScalarObjectInterface;

/**
 * Class implements an uncrypted plain password
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-23
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Password implements ScalarObjectInterface {

  /**
   * cost parameter
   *
   * @var string  
   */
  private $password;

  /**
   * Constructs a new instance
   * 
   * @param string $password the password string
   */
  public function __construct($password) {
    $this->password = strval($password);
  }

  /**
   * Returns the hashed password as an object
   * 
   * @return HashedPassword the hashed password as an object
   */
  public function getHashedPassword() {
    return new HashedPassword(Passwords::hash($this->password));
  }

  /**
   * Compare a password against a crypted one
   * 
   * @param  string|HashedPassword $cryptedPassword the crypted password to check against
   * @return boolean true if the password hash pair matches and false otherwise
   */
  public function validateHash($cryptedPassword) {
    return Passwords::checkPassword($cryptedPassword, $this->password);
  }

  public function __toString() {
    return $this->password;
  }

  public function equals($object) {
    if ($object instanceof HashedPassword) {
      return $this->validateHash($object);
    } else {
      return parent::equals($object);
    }
  }

  public function toScalar() {
    return $this->__toString();
  }

}
