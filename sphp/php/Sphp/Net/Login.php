<?php

/**
 * Login.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Net;

use Sphp\messageSys\MessageList as MessageList;
use Sphp\messageSys\Message as Message;
use Sphp\messageSys\ErrorMessage as ErrorMessage;

/**
 * Login class handles the user login/logout/session
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-05-28
 * @version 1.0
 *
 */
class Login {

	/**
	 * the session handler class
	 *
	 * @var Session
	 */
	private $session = null;

	/**
	 * collection of error / success / neutral messages
	 *
	 * @var MessageList
	 */
	private $messages;

	/**
	 * Constructor
	 *
	 * The possible login actions:
	 *
	 *  1. logout (happen when user clicks logout button)
	 *  2. login via $_REQUEST data, which means simply logging in via the login form. after the user has submit his username/password successfully, his
	 *     logged-in-status is written into his session data on the server. this is the typical behaviour of common login scripts.
	 */
	public function __construct() {
		$this->messages = new MessageList();
		try {
			$this->session = new Session();
			$this->session->start();
			if (isset($_REQUEST['sessionEvent'])) {
				if ($_REQUEST['sessionEvent'] == "logout") {
					$this->logout();
				} else if ($_REQUEST['sessionEvent'] == "login") {
					$this->login();
				}
			}
		} catch (Exception $e) {
			$this->session = null;
			$this->messages->setLine(new ErrorMessage("Tieotokantayhteyden muodostaminen epäonnistui", "DB"));
		}
		if (count($this->messages) > 0) {
			$_SESSION["messages"] = serialize($this->messages);
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
	public function login() {
		if (isset($_REQUEST['username'], $_REQUEST['password'])) {
			if (!$this->session->login($_REQUEST['username'], $_REQUEST['password'])) {
				$this->messages->setLine(new ErrorMessage("Käyttäjätunnus tai salasana on virheellinen", "LoginForm"));
			} else {
				$this->messages->setLine(new Message("Kirjautuminen onnistui", "LoginForm"));
			}
		} else {
			if (empty($_REQUEST["username"])) {
				$this->messages->setLine(new ErrorMessage("Käyttäjätunnus puuttuu", "username"));
			}
			if (empty($_REQUEST["password"])) {
				$this->messages->setLine(new ErrorMessage("Salasana puuttuu", "password"));
			}
		}
	}

	/**
	 * Perform the logout
	 */
	public function logout() {
		$this->session->logout();
		$this->messages->setLine(new Message("Uloskirjautuminen onnistui", "LoginForm"));
	}

	/**
	 * Returns all login messages
	 *
	 * @return MessageList|null all login messages
	 */
	public static function getLastMessages() {
		if (!empty($_SESSION["messages"])) {
			$m = unserialize($_SESSION["messages"]);
			return ($m instanceof MessageList) ? $m : null;
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
