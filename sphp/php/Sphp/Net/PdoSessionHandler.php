<?php

/**
 * PdoSessionHandler.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Net;

use \PDO as PDO;
use Sphp\Db\DatabaseConnector as PDOConnector;

/**
 * Class handles a session that stored ist data to a database
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-01
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class PdoSessionHandler extends AbstractSessionHandler {

  /**
   * the PDO object used to access the database
   *
   * @var PDO
   */
  private $pdo = null;

  /**
   * Sets the user-level session storage functions which are used
   * for storing and retrieving data associated with a session.
   *
   * @param PDO $pdo the PDO object used to access the database
   */
  public function __construct(PDO $pdo = null) {
    if ($pdo === null) {
      $this->pdo = PDOConnector::obtain();
    } else {
      $this->pdo = $pdo;
    }
    parent::__construct();
  }

  /**
   * Returns the current logged in user if thete is one
   *
   * @return User|null the current logged in user
   */
  public function getCurrentUser() {
    if (isset($_SESSION['sid'])) {
      return null; //$this->userTable->getByUsingSessionId($_SESSION["sid"]);
    } else {
      return null;
    }
  }

  /**
   * Is called to open a session.
   *
   * The method  does nothing because we do not want to write
   * into a file so we don't need to open one.
   *
   * @param  string $save_path the save path
   * @param  string $session_name the name of the session
   * @return boolean true on success, false on failure
   */
  public function open($save_path, $session_name) {
    return true;
  }

  /**
   * Is called to read data from a session.
   *
   * @param  string $id the id of the current session
   * @return string current session data
   */
  public function read($id) {
    $select = 'SELECT * FROM sessions WHERE id = :id LIMIT 1;';
    $selectStmt = $this->pdo->prepare($select);
    $selectStmt->bindParam(':id', $id, PDO::PARAM_STR);
    if ($selectStmt->execute()) {
      $result = $selectStmt->fetch(PDO::FETCH_ASSOC);
      return $result['value'];
    }
    return '';
  }

  /**
   * Writes data into a session rather into the session record in the database
   *
   * **Note** this value is returned internally to PHP for processing.
   *
   * @param  string $id the id of the current session
   * @param  string $sess_data the data of the session
   * @return boolean true on success, false on failure
   */
  public function write($id, $sess_data) {
    //echo "handler->write($id, $sess_data)\n";
    if ($sess_data == null) {
      return true;
    }
    $update = "UPDATE sessions SET last_updated = :time, value = :data
            WHERE id = :id;";
    $updateStmt = $this->pdo->prepare($update);
    $time = time();
    $updateStmt->bindParam(':time', $time, PDO::PARAM_INT);
    $updateStmt->bindParam(':data', $sess_data, PDO::PARAM_STR);
    $updateStmt->bindParam(':id', $id, PDO::PARAM_INT);
    if ($updateStmt->execute()) {
      if ($updateStmt->rowCount() > 0) {
        //echo "updated\n";
        return true;
      } else {
        $insert = "INSERT INTO sessions (id, last_updated, start, value)
					VALUES (:id, :time, :time, :data);";
        $insertStmt = $this->pdo->prepare($insert);
        $time = time();
        $insertStmt->bindParam(':time', $time, PDO::PARAM_INT);
        $insertStmt->bindParam(':data', $sess_data, PDO::PARAM_STR);
        $insertStmt->bindParam(':id', $id, PDO::PARAM_STR);
        echo "inserted\n";
        return $insertStmt->execute();
      }
    }
    return false;
  }

  /**
   * Ends a session and deletes it
   *
   * **Note** this value is returned internally to PHP for processing.
   *
   * @param  string $id the id of the current session
   * @return boolean true on success, false on failure
   */
  public function destroy($id) {
    //echo "handler->destroy($id)\n";
    $delete = "DELETE FROM sessions WHERE id = :id;";
    $deleteStmt = $this->pdo->prepare($delete);
    $deleteStmt->bindParam(':id', $id, PDO::PARAM_STR);
    return $deleteStmt->execute();
  }

  /**
   * The garbage collector deletes all sessions from the database that where
   * not deleted by the session_destroy function.
   * so your session table will stay clean.
   *
   * **Note** this value is returned internally to PHP for processing.
   *
   * @param  int $maxlifetime the maximum session lifetime
   * @return boolean true on success, false on failure
   */
  public function gc($maxlifetime) {
    //echo "handler->gc($maxlifetime)\n";
    $delete = "DELETE FROM sessions WHERE last_updated < :expired;";
    $deleteStmt = $this->pdo->prepare($delete);
    $expired = time() - $maxlifetime;
    $deleteStmt->bindParam(':expired', $expired, PDO::PARAM_INT);
    return $deleteStmt->execute();
  }

}
