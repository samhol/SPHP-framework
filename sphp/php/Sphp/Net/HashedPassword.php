<?php

/**
 * HashedPassword.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Net;

use Sphp\Objects\ScalarObjectInterface;

/**
 * Class implements a crypted password
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-23
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class HashedPassword implements ScalarObjectInterface {

  /**
   * the crypted password string
   *
   * @var string  
   */
  private $hashed;

  /**
   * Constructs a new instance
   * 
   * **Important:** <var>$hash</var> type conversions
   * 
   * 1. {@link Password} is hashed using {@link Password::getHashedPassword()}
   * 2. All other types are converted to string values using {@link \strval()}
   * 
   * @param mixed $hash the crypted password string
   */
  public function __construct($hash) {
    if ($hash instanceof Password) {
      //echo "gaggrew";
      $hash = $hash->getHashedPassword();
      $this->hashed = strval($hash);
    } else {
      $this->hashed = strval($hash);
    }
  }

  /**
   * Compares the crypted password against an uncrypted one
   * 
   * @param  string $password the password to check
   * @return boolean true if the password hash pair matches and false otherwise
   */
  public function validatePassword($password) {
    return Passwords::checkPassword($this->hashed, $password);
  }

  /**
   * {@inheritdoc}
   */
  public function __toString() {
    return $this->hashed;
  }

  /**
   * {@inheritdoc}
   */
  public function equals($object) {
    if ($object instanceof HashedPassword) {
      return $this->validateHash($object);
    } else {
      return parent::equals($object);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function toScalar() {
    return $this->__toString();
  }

}
