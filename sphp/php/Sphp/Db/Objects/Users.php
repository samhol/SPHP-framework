<?php

/**
 * Users.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db\Objects;

use Sphp\Db\Objects\User as User;
use Doctrine\ORM\EntityManagerInterface as EntityManagerInterface;

/**
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-05-20
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Users extends AbstractObjectStorage {

  private $em;

  /**
   * Constructor
   *
   * @param EntityManagerInterface $em
   */
  public function __construct(EntityManagerInterface $em = null) {
    parent::__construct(User::class, $em);
    //$this->em = $em;
  }

  /**
   * Returns a
   *
   * @param  string $username the username
   * @return User|null  the user or null if nothing was found
   */
  public function getByUsingUsername($username) {
    $query = $this->getManager()->createQuery('SELECT u FROM ' . User::class . ' u WHERE u.username = :uname');
    $query->setParameter('uname', $username);
    $users = $query->getResult();
    $user = null;
    if (count($users) > 0) {
      $user = $users[0];
    } 
    return $user;
  }

  /**
   * {@inheritdoc}
   */
  public function contains(DbObjectInterface $object) {
    if (!$this->getManager()->contains($object) && $object instanceof User) {
      $this->getManager()->getRepository($this->getObjectType())->findAll();
    }
    return $this->getManager()->contains($object);
  }

  public function insert(User $user) {
    $this->em->persist($user);
    $this->em->flush();
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
   * Terkistaa, onko annetun käyttäjän käyttäjätunnus järjestelmässä uniikki.
   *
   * @param  User $user the user
   * @return boolean true, if username is unique for the use, false otherwise.
   */
  public function uniqueUserName(User $user) {
    $db = $this->query();
    $db->where()
            ->equals([self::USERNAME => $user->getUsername()])
            ->isNot(self::DBID, $user->getPrimaryKey());
    return $db->count() == 0;
  }

  /**
   * Confirms the uniqueness of the user's first and last name
   *
   * @param  User $user the user
   * @return boolean true if user's first and last name are unique, otherwise false
   */
  public function uniquePersonName(User $user) {
    $db = clone $this->db()->select();
    return $db->where(Condition::equals(self::FNAME, $user->getFname()))
                    ->where(Condition::equals(self::LNAME, $user->getLname()))
                    ->where(Condition::isNot(self::DBID, $user->getPrimaryKey()))->count() == 0;
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
    $user = $this->getByUsingUsername($username);
    $i = 1;
    $_username = empty($username) ? "user" : $username;
    while (isset($user) && $user->getPrimaryKey() != $dbID) {
      $_username = $username . $i++;
      $user = $this->getByUsingUsername($_username);
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

}
