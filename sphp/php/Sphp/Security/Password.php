<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Security;

/**
 * Implements a verifiable password
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
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
   * Constructor
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
