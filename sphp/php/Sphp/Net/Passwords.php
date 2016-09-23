<?php

/**
 * Passwords.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Net;

/**
 * Class contains password crypting and validation functionality
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-11-23
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Passwords {

  /**
   * blowfish
   *
   * @var string   
   */
  private static $algo = '$2a';

  /**
   * cost parameter
   *
   * @var string  
   */
  private static $cost = '$10';

  /**
   * Generates the salt for password crypting
   * 
   * @return string the salt for password crypting
   */
  private static function uniqueSalt() {
    return substr(sha1(mt_rand()), 0, 22);
  }

  /**
   * Crypts a password
   * 
   * @param  string $password the password to crypt
   * @return string hashed password
   */
  public static function hash($password) {
    return crypt($password, self::$algo . self::$cost . '$' . self::uniqueSalt());
  }

  /**
   * Compare a password against a crypted one
   * 
   * @param  string $cryptedPassword the crypted password to check against
   * @param  string $password the password to check
   * @return boolean true if the password hash pair matches and false otherwise
   */
  public static function checkPassword($cryptedPassword, $password) {
    $full_salt = substr($cryptedPassword, 0, 29);
    $new_hash = crypt($password, $full_salt);
    return ($cryptedPassword == $new_hash);
  }

}
