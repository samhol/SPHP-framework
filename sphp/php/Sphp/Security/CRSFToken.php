<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Security;

use Sphp\Exceptions\RuntimeException;
use Sphp\Html\Forms\Inputs\HiddenInput;
use Sphp\Stdlib\Random\UUID;
use Sphp\Html\Forms\HtmlForm;

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
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class CRSFToken {

  /**
   * Constructor
   * 
   * @throws RuntimeException if there is no session
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
  public function generateToken(string $tokenName): string {
    if (array_key_exists($tokenName, $_SESSION)) {
      return $_SESSION[$tokenName];
    } else {
      $token = UUID::v5(UUID::v4(), $tokenName);
      $_SESSION[$tokenName] = $token;
      return $token;
    }
  }

  /**
   * Creates a CRSF token input to use
   * 
   * @param  string $tokenName the CRSF token name
   * @return HiddenInput the CRSF token input generated
   */
  public function generateTokenInput(string $tokenName): HiddenInput {
    return new HiddenInput($tokenName, $this->generateToken($tokenName));
  }

  public function insertIntoForm(HtmlForm $form, string $tokenName) {
    $form->appendHiddenInput($tokenName, $this->generateToken($tokenName));
  }

  /**
   * Unsets the given CRSF token
   * 
   * @param  string $tokenName the CRSF token name
   * @return $this for a fluent interface
   */
  public function unsetToken(string $tokenName) {
    if (array_key_exists($tokenName, $_SESSION)) {
      unset($_SESSION[$tokenName]);
    }
    return $this;
  }

  /**
   * Verifies a named CRSF token from the input data
   * 
   * @param string $tokenName the CRSF token name
   * @param array $data
   * @return bool true if the token value matches
   */
  public function verifyToken(string $tokenName, array $data): bool {
    $verified = false;
    if (array_key_exists($tokenName, $data)) {
      $token = $data[$tokenName];
      if (array_key_exists($tokenName, $_SESSION) && $_SESSION[$tokenName] === $token) {
        $verified = true;
      }
    }
    return $verified;
  }

  /**
   * Verifies a named CRSF token from the input data
   * 
   * @param  string $tokenName the CRSF token name
   * @param  int $type input type
   * @return bool true if the token value matches
   * @codeCoverageIgnore
   */
  public function verifyInputToken(string $tokenName, int $type): bool {
    $token = filter_input($type, $tokenName, FILTER_SANITIZE_STRING);
    if (!isset($_SESSION[$tokenName])) {
      return false;
    }
    if ($_SESSION[$tokenName] !== $token) {
      return false;
    }

    return true;
  }

  /**
   * Verifies a named CRSF token from the POST data
   * 
   * @param  string $tokenName the CRSF token name
   * @return bool true if the token value matches
   * @codeCoverageIgnore
   */
  public function verifyPostToken(string $tokenName): bool {
    return $this->verifyInputToken($tokenName, \INPUT_POST);
  }

  /**
   * Verifies a named CRSF token from the GET data
   * 
   * @param  string $tokenName the CRSF token name
   * @return bool true if the token value matches
   * @codeCoverageIgnore
   */
  public function verifyGetToken(string $tokenName): bool {
    return $this->verifyInputToken($tokenName, \INPUT_GET);
  }


}
