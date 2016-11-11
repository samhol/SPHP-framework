<?php

/**
 * HashedPassword.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Net;

/**
 * Implements a verifiable crypted password
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-10-23
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 * @Embeddable
 */
class HashedPassword extends AbstractPassword {

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
  public function __construct($hash) {
    if ($hash instanceof PasswordInterface) {
      $this->hash = $hash->getHash();
    } else {
      $this->hash = strval($hash);
    }
  }

  public function __toString() {
    return $this->hash;
  }

  public function getHash() {
    return $this->hash;
  }

}
