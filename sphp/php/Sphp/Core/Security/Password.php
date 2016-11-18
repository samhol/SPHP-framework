<?php

/**
 * Password.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Security;

use Sphp\Db\Objects\Embeddable;

/**
 * Implements a verifiable password
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-10-23
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 * @Embeddable
 */
class Password implements PasswordInterface, Embeddable {

  /**
   * the crypted password string
   *
   * @var string  
   * @Column(type = "string")
   */
  private $hash;

  /**
   * Constructs a new instance
   * 
   * **Important:** <var>$hash</var> type conversions
   * 
   * 1. {@link Password} is hashed using {@link Password::getHash()}
   * 2. All other types are converted to string values using {@link \strval()}
   * 
   * @param string|PasswordInterface $hash the crypted password string
   */
  protected function __construct($hash) {
    if ($hash instanceof PasswordInterface) {
      $this->hash = $hash->getHash();
    } else {
      $this->hash = strval($hash);
    }
  }

  public function __toString() {
    return $this->hash;
  }

  public function verify($password) {
    return password_verify((string) $password, $this->getHash());
  }

  public function getHash() {
    return $this->hash;
  }

  /**
   * 
   * @param string $hash the crypted password string
   * @return self
   */
  public static function fromHash($hash) {
    return new static($hash);
  }

  /**
   * Constructs a new instance
   * 
   * @param string $password uncrypted plain password string
   * @param  int $algo
   * @param  array $options
   * @return self
   */
  public static function fromPassword($password, $algo = PASSWORD_DEFAULT, array $options = []) {
    $hash = password_hash((string) $password, $algo, $options);
    return static::fromHash($hash);
  }

}
