<?php

/**
 * SessionUserStorage.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database\Objects;

use Sphp\Db\Objects\User;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Implements a {@link SessionUser} storage
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SessionUserStorage extends AbstractObjectStorage {

  /**
   * Constructs a new instance
   *
   * @param EntityManagerInterface $em
   */
  public function __construct(EntityManagerInterface $em = null) {
    parent::__construct(SessionUser::class, $em);
  }

  public function exists(DbObjectInterface $id) {
    if ($id instanceof SessionUser) {
      $username = $id->getUsername();
    }
    $query = $this->getManager()
            ->createQuery('SELECT COUNT(obj.id) FROM ' . $this->getObjectType() . " obj WHERE obj.username = :username");
    $query->setParameter('username', $username);
    return $query->getSingleScalarResult() == 1;
  }

  /**
   * 
   *
   * @param  string $username the username of the user
   * @return User|null  the user or null if nothing was found
   */
  public function findByUsername($username) {
    if ($username instanceof UserInterface) {
      $username = $username->getUsername();
    }
    return $this->getRepository()->findOneBy(['username' => $username]);
  }

  /**
   * 
   *
   * @param  string $email the email of the user
   * @return User|null  the user or null if nothing was found
   */
  public function findByEmail($email) {
    if ($email instanceof UserInterface) {
      $email = $email->getEmail();
    }
    return $this->getRepository()->findOneBy(['email' => $email]);
  }

  public function contains(DbObjectInterface $object) {
    return $object->existsIn($this->getManager());
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
   * @param  string $username username
   * @param  string $password plain password
   * @return SessionUser|null the matching user ot null if none found
   */
  public function findByUserPass($username, $password) {
    $candidate = $this->getRepository()->findOneBy(['username' => $username]);
    if ($candidate !== null && $candidate->getPassword()->verify($password)) {
      return $candidate;
    } else {
      return null;
    }
  }

}
