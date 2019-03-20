<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Network\Session;

use SessionHandlerInterface;

/**
 * Class handles a PHP session
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractSessionHandler implements SessionHandlerInterface {

  /**
   * the number of seconds after which session data will be seen as garbage
   *
   * @var int
   */
  private $maxlifetime = 1800;

  /**
   * Constructs a new session object
   * 
   * Sets the user-level session storage functions which are used
   * for storing and retrieving data associated with a session.
   */
  public function __construct() {
    $this->maxlifetime = ini_get('session.gc_maxlifetime');
    session_set_save_handler($this, true);
  }

  /**
   * Starts the session if it is possible
   *
   * @return boolean true on success, false on failure
   */
  public function startSession(): bool {
    if (session_status() !== PHP_SESSION_ACTIVE && !headers_sent()) {
      session_start();
      //$this->setLocales();
      return true;
    }
    return false;
  }

  /**
   * Returns string the id of the current session
   * 
   * @return string the id of the current session
   */
  public function getSessionId(): string {
    return session_id();
  }

  /**
   * Sets the number of seconds after which session data will be seen as
   *  garbage
   *
   * @param  int $maxlifetime the number of seconds after which session data
   *         will be seen as garbage
   * @return $this for a fluent interface
   */
  public function setMaxlifetime(int $maxlifetime) {
    $this->maxlifetime = $maxlifetime;
    ini_set('session.gc_maxlifetime', $maxlifetime);
    return $this;
  }

  /**
   * Returns the number of seconds after which session data will be seen as
   *  garbage
   * 
   * @return int the number of seconds after which session data will be seen 
   * as garbage
   */
  public function getMaxlifetime(): int {
    return $this->maxlifetime;
  }

  /**
   * Is called when the reading in a session is completed. The method calls
   *  the garbage collector.
   *
   * **Note** this value is returned internally to PHP for processing.
   *
   * @return boolean true on success, false on failure
   */
  public function close(): bool {
    $this->gc($this->maxlifetime);
    return true;
  }

}
