<?php

/**
 * Login.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Security;

use Sphp\Core\I18n\TopicList;
use Sphp\Core\I18n\Message;

/**
 * Login class handles the user login/logout/session
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-05-28
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Login {

  /**
   * the session handler class
   *
   * @var PdoSessionHandler
   */
  private $session = null;

  /**
   * collection of error / success / neutral messages
   *
   * @var TopicList
   */
  private $messages;

  /**
   * Constructs a new instance
   *
   * The possible login actions:
   *
   *  1. logout (happen when user clicks logout button)
   *  2. login via $_REQUEST data, which means simply logging in via the login form. after the user has submit his username/password successfully, his
   *     logged-in-status is written into his session data on the server. this is the typical behaviour of common login scripts.
   */
  public function __construct(\SessionHandlerInterface $sessionHandler = null) {
    $this->messages = new TopicList();
    try {
      if ($sessionHandler === null) {
        $this->session = new PdoSessionHandler();
      }
      $this->session->startSession();
      if (isset($_REQUEST['sessionEvent'])) {
        if ($_REQUEST['sessionEvent'] == "logout") {
          $this->logout();
        } else if ($_REQUEST['sessionEvent'] == "login") {
          $this->login();
        }
      }
    } catch (\Exception $e) {
      $this->session = null;
      $this->messages->offsetSet("DB", new Message("Tieotokantayhteyden muodostaminen epäonnistui"));
    }
    if (count($this->messages) > 0) {
      $_SESSION["messages"] = $this->messages;
    }
  }

  /**
   * Returns the session object
   *
   * @return Session the session object
   */
  public function getSession() {
    return $this->session;
  }

  /**
   * Does the login process when a login form is submitted
   */
  public function login($username = null, $password = null) {
    if (isset($username, $password)) {
      if (!$this->session->login($username, $password)) {
        $this->messages->offsetSet("LoginForm", new Message("Käyttäjätunnus tai salasana on virheellinen"));
      } else {
        $this->messages->offsetSet("LoginForm", new Message("Kirjautuminen onnistui"));
      }
    }
  }

  /**
   * Perform the logout
   */
  public function logout() {
    $this->session->logout();
    $this->messages->insert(new Message("Uloskirjautuminen onnistui", "LoginForm"));
  }

  /**
   * 
   * @return TopicList
   */
  public function getMessages() {
    return $this->messages;
  }

  /**
   * Returns all login messages
   *
   * @return MessageList|null all login messages
   */
  public static function getLastMessages() {
    if (!empty($_SESSION["messages"])) {
      $m = unserialize($_SESSION["messages"]);
      return ($m instanceof PrioritizedMessageList) ? $m : null;
    }
    return null;
  }

  /**
   * Clears all login messages
   */
  public static function clearLastMessages() {
    if (isset($_SESSION["messages"])) {
      unset($_SESSION["messages"]);
    }
  }

}

?>
