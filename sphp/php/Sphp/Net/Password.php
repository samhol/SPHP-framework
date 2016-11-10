<?php

/**
 * Password.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Net;

/**
 * Implements an uncrypted verifiable plain password
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-10-23
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Password extends AbstractPassword {

  /**
   * the uncrypted plain password string
   *
   * @var string  
   */
  private $password;

  /**
   * Constructs a new instance
   * 
   * @param string $password uncrypted plain password string
   */
  public function __construct($password) {
    $this->password = (string) $password;
  }

  public function __toString() {
    return $this->password;
  }

  /**
   * 
   * @param  int $algo
   * @param  array $options
   * @return HashedPassword
   */
  public function getHashInstance($algo = PASSWORD_DEFAULT, array $options = []) {
    return new HashedPassword($this->getHash($algo, $options));
  }

  /**
   * 
   * @param  int $algo
   * @param  array $options
   */
  public function getHash($algo = PASSWORD_DEFAULT, array $options = []) {
    return password_hash($this->password, $algo, $options);
  }

}
