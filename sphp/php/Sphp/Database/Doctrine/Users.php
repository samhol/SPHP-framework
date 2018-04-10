<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database\Doctrine;

use Sphp\Db\Objects\User;
use Doctrine\ORM\EntityManagerInterface;

/**
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Users extends AbstractObjectStorage {

  /**
   * Constructor
   *
   * @param EntityManagerInterface $em
   */
  public function __construct(EntityManagerInterface $em = null) {
    parent::__construct(User::class, $em);
  }

  /**
   * 
   *
   * @param  string $username the username
   * @return User|null  the user or null if nothing was found
   */
  public function findByUsername($username) {
    return $this->getRepository()->findOneBy(['username' => $username]);
  }

  public function contains(DbObjectInterface $object) {
    if (!$this->getManager()->contains($object) && $object instanceof User) {
      $this->getManager()->getRepository($this->getObjectType())->findAll();
    }
    return $this->getManager()->contains($object);
  }

  /**
   * Returns sessio-id:tä vastaavan käyttäjän.
   *
   * @param  string $sid session id
   * @return User|null the user or null if nothing was found
   */
  public function getByUsingSessionID($sid) {
    $sessionsTable = new Select($this->getPDO());
    $sessionsTable->columns("userID")->from("Sessions")->where(Condition::equals("sid", $sid));
    return $this->getFirst(Condition::isIn(self::DBID, $sessionsTable));
  }

  /**
   * Confirms the uniqueness of the users's username in the repository
   *
   * @param  User|string $needle the user instance or the username string
   * @return boolean true, if username is unique, false otherwise.
   */
  public function uniqueUserName($needle) {
    $result = false;
    if ($needle instanceof User) {
      $result = $needle->usernameTaken($this->getManager());
    } else {
      $query = $this->getManager()
              ->createQuery('SELECT COUNT(u.id) FROM ' . $this->getObjectType() . " u WHERE u.username = :username");
      $query->setParameter("username", $needle);
      $result = $query->getSingleScalarResult() == 0;
    }
    return $result;
  }

  /**
   * Confirms the uniqueness of the users's email in the repository
   *
   * @param  User|string $needle the user instance or the email address of the user
   * @return boolean true if user's email is unique, otherwise false
   */
  public function uniqueEmail($needle) {
    $result = false;
    if ($needle instanceof User) {
      $result = $needle->usernameTaken($this->getManager());
    } else {
      $query = $this->getManager()
              ->createQuery('SELECT COUNT(u.id) FROM ' . $this->getObjectType() . " u WHERE u.email = :email");
      $query->setParameter("email", $needle);
      $result = $query->getSingleScalarResult() == 0;
    }
    return $result;
  }

  /**
   * Returns unique username from given first- and lastname.
   *
   * **Notes:**
   *
   * - tries to take first 3 letters from first- and lastname to the returned username
   * - adds an ordinal to the end of username to ensure uniqueness in current database.
   *
   * @param  string $fname user's firstname
   * @param  string $lname user's lastname
   * @param  int $dbID user's database id
   * @return string unique username
   */
  public function generateValidUsername($fname, $lname, $dbID = -1) {
    $patterns = ["/(å|ä)/i", "/ö/i", "/é/i", "/(û|ü)/i", "/[^a-zA-Z]/"];
    $replacements = ['a', 'o', 'e', 'u', ""];
    $s1 = preg_replace($patterns, $replacements, $fname);
    $s2 = preg_replace($patterns, $replacements, $lname);
    //$fname = preg_replace("/[^a-zA-Z]/", "", $fname);
    //$lname = preg_replace("/[^a-zA-Z]/", "", $lname);
    $username = strtolower(substr($s1, 0, 3) . substr($s2, 0, 3));
    $user = $this->findByUsername($username);
    $i = 1;
    $_username = empty($username) ? "user" : $username;
    while (isset($user) && $user->getPrimaryKey() != $dbID) {
      $_username = $username . $i++;
      $user = $this->findByUsername($_username);
    }
    $username = $_username;
    return $username;
  }

  /**
   * Confirms the username password combination.
   *
   * @param  string $user the user's username
   * @param  string $password the user's password
   * @return boolean true if confirmed, false otherwise
   */
  public function confirmUserPass($user, $password) {
    $pwHash = $this->db()->select()->columns(User::PASSWORD)
            ->where(Condition::equals(User::USERNAME, $user));
    return Password::checkPassword($pwHash, $password);
  }

  /**
   * Changes users password.
   *
   * @param  User $user the user
   * @param  Password $password new password
   * @return boolean true if the user's password is changed, false otherwise
   */
  public function changePassword(User $user, Password $password) {
    /* SQL: käyttäjän päivitys */
    $query = sprintf("UPDATE UserTable SET password = %s WHERE dbID = %s", MySQLgen::filterData($password), MySQLgen::filterData($user->getPrimaryKey()));
    /* Kannan päivitys onnistui */
    if ($this->executeQuery("START TRANSACTION") && $this->executeQuery($query) && $this->executeQuery("COMMIT")) {
      return true;
    } else {/* Kannan päivitys peruuntui */
      $this->executeQuery("ROLLBACK");
      return false;
    }
  }

  public function exists(DbObjectInterface $id) {
    
  }

}
