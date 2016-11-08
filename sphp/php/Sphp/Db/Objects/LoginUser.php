<?php

/**
 * LoginUser.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db\Objects;

use Sphp\Net\Password;
use Sphp\Net\HashedPassword;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class Models a system user
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2007-04-10
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 * @Entity
 * @Table(name="users",uniqueConstraints={@UniqueConstraint(name="uniquePersonName", columns={"fname", "lname"})})
 */
class LoginUser extends AbstractDbObject implements UserInterface {

  use \Sphp\Objects\ToArrayTrait;

  /**
   * primary database key
   *
   * @var int 
   * @Id @Column(type="integer")
   * @GeneratedValue
   */
  private $id;

  /**
   * The username
   *
   * @var string 
   * @Column(type="string", length=30)
   */
  private $username;

  /**
   * the email address of the user
   * 
   * @var string
   * @Column(type="string", nullable=true)
   * @Assert\Email
   */
  private $email;

  /**
   * the password
   *
   * @var string 
   * @Column(type="string", length=64)
   */
  private $password;

  public function __construct($data = []) {
    //$this->address = new Address();
    //$this->phonenumbers = new \Doctrine\Common\Collections\ArrayCollection();
    //$this->emails = new \Doctrine\Common\Collections\ArrayCollection();
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
    $this->permissions = $permissions;
    return $this;
  }

  public function getPassword() {
    return $this->password;
  }

  public function setPassword($password = "") {
    $this->password = new HashedPassword($password);
    return $this;
  }

  public function fromArray(array $data = []) {
    $args = [
        'id' => \FILTER_VALIDATE_INT,
        'username' => \FILTER_SANITIZE_STRING,
        'email' => \FILTER_SANITIZE_STRING,
        'permissions' => \FILTER_SANITIZE_STRING,
        'password' => \FILTER_SANITIZE_STRING
    ];
    $myinputs = filter_var_array($data, $args, true);
    $this->setPrimaryKey($myinputs['id'])
            ->setUsername($myinputs['username'])
            ->setEmail($myinputs['email'])
            ->setPermissions($myinputs['permissions'])
            ->setPassword($myinputs['password']);
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
      $query = $em->createQuery('SELECT COUNT(u.id) FROM ' . self::class . " u WHERE u.username = :username OR u.email != :email");
      $query->setParameter("username", $this->username);
      $query->setParameter("email", $this->email);
      $count = $query->getSingleScalarResult();
      $isManaged = $count != 0;
    }
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

}
