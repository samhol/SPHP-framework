<?php

/**
 * SessionUser.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db\Objects;

use Sphp\Core\Security\Password;
use Sphp\Core\Security\PasswordInterface;
use Sphp\Core\Security\Permissions;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Implements a system user
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2007-04-10
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 * @Entity
 * @Table(name="session_users")
 */
class SessionUser extends AbstractDbObject implements UserInterface {

  /**
   * primary database key
   *
   * @var int 
   * @Id @Column(type="integer")
   * @GeneratedValue
   */
  protected $id;

  /**
   * username
   *
   * @var string 
   * @Column(type="string", length=255)
   */
  protected $username;

  /**
   * email address
   * 
   * @var string
   * @Column(type="string", nullable=false)
   * @Assert\Email
   */
  protected $email;

  /**
   * password
   *
   * @var Password 
   * @Embedded(class = "Sphp\Core\Security\Password", columnPrefix = "password_")
   */
  protected $password;

  /**
   * @var Permissions
   * @Embedded(class = "Sphp\Core\Security\Permissions", columnPrefix = "permission_") 
   */
  protected $permissions;

  public function __construct($data = []) {
    parent::__construct($data);
  }

  public function getUsername() {
    return $this->username;
  }

  public function setUsername($username) {
    $this->username = $username;
    return $this;
  }

  public function getEmail() {
    return $this->email;
  }

  public function setEmail($email) {
    $this->email = $email;
    return $this;
  }

  public function getPermissions() {
    return $this->permissions;
  }

  public function setPermissions($permissions = 0) {
    if (!$permissions instanceof Permissions) {
      $permissions = new Permissions($permissions);
    }
    $this->permissions = $permissions;
    return $this;
  }

  public function getPassword() {
    return $this->password;
  }

  public function setPlainPassword($password) {
    $this->password = Password::fromPassword($password);
    return $this;
  }

  public function setPassword(PasswordInterface $password) {
    $this->password = Password::fromHash($password);
    return $this;
  }

  public function fromArray(array $data = []) {
    $args = [
        'id' => \FILTER_VALIDATE_INT,
        'username' => \FILTER_SANITIZE_STRING,
        'email' => \FILTER_SANITIZE_STRING,
        'permissions_mask' => \FILTER_SANITIZE_NUMBER_INT,
        'password' => \FILTER_SANITIZE_STRING
    ];
    $myinputs = filter_var_array($data, $args, true);
    $this->setPrimaryKey($myinputs['id'])
            ->setUsername($myinputs['username'])
            ->setEmail($myinputs['email'])
            ->setPermissions($myinputs['permissions_mask'])
            ->setPassword(Password::fromPassword($myinputs['password']));
    return $this;
  }

  public function getPrimaryKey() {
    return $this->id;
  }

  public function setPrimaryKey($id) {
    $this->id = $id;
    return $this;
  }

  public function equals($object) {
    $class = self::class;
    $result = false;
    if ($object instanceof $class) {
      $result = $this->getUsername() == $object->getUsername() && $this->getEmail() == $object->getEmail();
    }
    return $result;
  }

  public function existsIn(EntityManagerInterface $em) {

    $isManaged = $this->isManagedBy($em);
    if (!$isManaged) {
      //$repo = $em->getRepository(self::class);
      //$repo->findOneBy($this->toArray());

      $query = $em->createQuery('SELECT COUNT(u.id) FROM ' . self::class . " u WHERE u.username = :username AND u.email = :email");
      $query->setParameter("username", $this->username);
      $query->setParameter("email", $this->email);
      $count = $query->getSingleScalarResult();
      $isManaged = $count != 0;
    }
    echo "existsIn:\n";
    var_dump($isManaged);
    return $isManaged;
  }

  /**
   * 
   * @param  EntityManagerInterface $em the entity manager
   * @return boolean true if users username is already taken by another user entity
   */
  public function usernameTaken(EntityManagerInterface $em) {
    if ($this->isManagedBy($em)) {
      $query = $em->createQuery('SELECT COUNT(obj.username) FROM ' . self::class . " obj WHERE obj.username = :username AND obj.id != :id");
      $query->setParameter("username", $this->username);
      $query->setParameter("id", $this->id);
    } else {
      $query = $em->createQuery('SELECT COUNT(obj.username) FROM ' . self::class . " obj WHERE obj.username = :username");
      $query->setParameter("username", $this->username);
    }
    $count = $query->getSingleScalarResult();
    return $count > 0;
  }

  /**
   * 
   * @param  EntityManagerInterface $em
   * @return boolean 
   */
  public function emailTaken(EntityManagerInterface $em) {
    if ($this->isManagedBy($em)) {
      $query = $em->createQuery('SELECT COUNT(obj.email) FROM ' . self::class . " obj WHERE obj.email = :email AND obj.id != :id");
      $query->setParameter("email", $this->email);
      $query->setParameter("id", $this->id);
    } else {
      $query = $em->createQuery('SELECT COUNT(obj.username) FROM ' . self::class . " obj WHERE obj.username = :username");
      $query->setParameter("email", $this->email);
    }
    $count = $query->getSingleScalarResult();
    return $count > 0;
  }

  public function toArray() {
    return [
        'id' => $this->getPrimaryKey(),
        'username' => $this->getUsername(),
        'email' => $this->getEmail(),
        'password_hash' => $this->getPassword()->getHash(),
        'permissions_mask' => $this->getPermissions()->toInt()
    ];
  }

}
