<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Network\Session;

use PDO;
use Sphp\Db\DatabaseConnector;

/**
 * Class handles a session that stored ist data to a database
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
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
   * Constructs a new session object
   * 
   * Sets the user-level session storage functions which are used
   * for storing and retrieving data associated with a session.
   *
   * @param PDO $pdo the PDO object used to access the database
   */
  public function __construct(PDO $pdo = null) {
    if ($pdo === null) {
      $this->pdo = DatabaseConnector::obtain();
    } else {
      $this->pdo = $pdo;
    }
    parent::__construct();
  }

  public function login($username, $password) {
    $users = new \Sphp\Db\Objects\SessionUserStorage();
    $user = $users->findByUserPass($username, $password);
    if ($user !== null) {
      //echo "handler->write($id, $sess_data)\n";
      
      $update = "UPDATE sessions SET user_id = :uid
            WHERE id = :id;";
      $updateStmt = $this->pdo->prepare($update);
      $uid = $user->getPrimaryKey();
      $updateStmt->bindParam(':uid', $uid, PDO::PARAM_STR);
      $sid = $this->getSessionId();
      $updateStmt->bindParam(':id', $sid, PDO::PARAM_INT);
      if ($updateStmt->execute()) {
        if ($updateStmt->rowCount() <= 0) {
          //echo "updated\n";
          //throw new \Exception('no rows');
        } else {
          //throw new \Exception();
        }
      }
    }
    return $user !== null;
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
    if ($this->pdo !== null) {
      // Return True
      return true;
    }
    // Return False
    return false;
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
