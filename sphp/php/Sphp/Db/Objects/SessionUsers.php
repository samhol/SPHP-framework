<?php

/**
 * SessionUsers.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db\Objects;

use Sphp\Db\Objects\User;
use Doctrine\ORM\EntityManagerInterface;

/**
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-05-20
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SessionUsers extends AbstractObjectStorage {

  /**
   * Constructs a new instance
   *
   * @param EntityManagerInterface $em
   */
  public function __construct(EntityManagerInterface $em = null) {
    parent::__construct(SessionUser::class, $em);
  }

  /**
   * 
   *
   * @param  string $username the username of the user
   * @return User|null  the user or null if nothing was found
   */
  public function findByUsername($username) {
    return $this->getRepository()->findOneBy(['username' => $username]);
  }

  /**
   * 
   *
   * @param  string $email the email of the user
   * @return User|null  the user or null if nothing was found
   */
  public function findByEmail($email) {
    return $this->getRepository()->findOneBy(['email' => $email]);
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

}
