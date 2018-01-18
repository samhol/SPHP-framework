<?php

/**
 * Password.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Security;

/**
 * Implements a verifiable password
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 * @Embeddable
 */
class Password implements PasswordInterface {

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
   * @param string|PasswordInterface $hash the crypted password string
   */
  protected function __construct($hash) {
    if ($hash instanceof PasswordInterface) {
      $this->hash = $hash->getHash();
    } else {
      $this->hash = strval($hash);
    }
  }

  public function verify($password): bool {
    return password_verify((string) $password, $this->getHash());
  }

  public function getHash(): string {
    return $this->hash;
  }

  /**
   * 
   * @param string $hash the crypted password string
   * @return PasswordInterface
   */
  public static function fromHash($hash): PasswordInterface {
    return new static($hash);
  }

  /**
   * Creates a new instance from plain password
   * 
   * @param string $password uncrypted plain password string
   * @param  int $algo
   * @param  array $options
   * @return PasswordInterface
   */
  public static function fromPassword($password, $algo = PASSWORD_DEFAULT, array $options = []): PasswordInterface {
    $hash = password_hash((string) $password, $algo, $options);
    return static::fromHash($hash);
  }

}
