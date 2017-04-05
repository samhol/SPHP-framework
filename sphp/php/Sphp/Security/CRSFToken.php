<?php

/**
 * CRSFToken.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Security;

use Sphp\Exceptions\RuntimeException;

/**
 * Implements a CRSF token generator and validator
 *
 * **First:** generate a new token and put it in a hidden field
 * 
 * <code>
 * <?php
 *   $newToken = CRSFToken::instance()->generateToken('token');
 * ?>
 * <form action="/action_page.php" method="post">
 *   ...
 *   <input type="hidden" name="token" value="<?php echo $newToken; ?>">
 *   ...
 * </form>
 * </code>
 * 
 * **Second:** Validate the token when processing the form
 * 
 * <code>
 * <?php
 *   if (CRSFToken::instance()->verifyPostToken('token')) {
 *     // ... more security testing
 *   }
 * ?>
 * </code>
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-03-16
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class CRSFToken {

  /**
   *
   * @var self
   */
  private static $instance;

  /**
   * Constructs a new instance
   * 
   * @throws \Sphp\Exceptions\RuntimeException if there is no session
   */
  public function __construct() {
    if (session_status() == PHP_SESSION_NONE) {
      if (!session_start()) {
        throw new RuntimeException('There is no session');
      }
    }
  }

  /**
   * Creates a CRSF token to use
   * 
   * @param  string $tokenName the CRSF token name
   * @return string the CRSF token generated
   */
  public function generateToken($tokenName) {
    $token = md5(uniqid(microtime(), true));
    $_SESSION[$tokenName . '_token'] = $token;
    return $token;
  }

  /**
   * Verifies a named CRSF token from the input data
   * 
   * @param  string $tokenName the CRSF token name
   * @param  int $type
   * @return boolean true if the token value matches
   */
  public function verifyInputToken($tokenName, $type) {
    $token = filter_input($type, $tokenName, FILTER_SANITIZE_STRING);
    if (!isset($_SESSION[$tokenName . '_token'])) {
      return false;
    }
    if ($_SESSION[$tokenName . '_token'] !== $token) {
      return false;
    }

    return true;
  }

  /**
   * Verifies a named CRSF token from the POST data
   * 
   * @param  string $tokenName the CRSF token name
   * @return boolean true if the token value matches
   */
  public function verifyPostToken($tokenName) {
    return $this->verifyInputToken($tokenName, \INPUT_POST);
  }

  /**
   * Verifies a named CRSF token from the GET data
   * 
   * @param  string $tokenName the CRSF token name
   * @return boolean true if the token value matches
   */
  public function verifyGetToken($tokenName) {
    return $this->verifyInputToken($tokenName, \INPUT_GET);
  }

  /**
   * Returns the singleton instance of a CRSF token generator
   * 
   * @return self singleton instance
   */
  public static function instance() {
    if (static::$instance === null) {
      static::$instance = new static();
    }
    return static::$instance;
  }

}
