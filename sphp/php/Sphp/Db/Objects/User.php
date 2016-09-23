<?php

/**
 * User.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db\Objects;

use Sphp\Core\Types\Arrays;
use Sphp\Net\Password as Password;
use Sphp\Net\HashedPassword as HashedPassword;
use Doctrine\ORM\EntityManagerInterface as EntityManagerInterface;

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
class User extends AbstractDbObject {

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
   * The first name of the user
   *
   * @var string 
   * @Column(length=50)
   */
  private $fname;

  /**
   * The last name of the user
   * 
   * @var string 
   * @Column(length=50)
   */
  private $lname;

  /**
   * The geographical address of the user
   * 
   * @var Address 
   * @ManyToOne(targetEntity="Address", cascade={"persist"})
   * @JoinColumn(name="address_id", referencedColumnName="id", nullable=false)
   */
  private $address;

  /**
   * the email address of the user
   * 
   * @var string
   * @Column(type="string", nullable=true)
   * @Assert\Email
   */
  private $email;

  /**
   * 
   * @var string[]
   * @Column(type="simple_array")
   */
  private $phonenumbers = [];

  public function __construct($data = array()) {
    //$this->address = new Address();
    //$this->phonenumbers = new \Doctrine\Common\Collections\ArrayCollection();
    //$this->emails = new \Doctrine\Common\Collections\ArrayCollection();
    parent::__construct($data);
  }

  /**
   * Returns the username
   *
   * @return string the username
   */
  public function getUsername() {
    return $this->username;
  }

  /**
   * Sets the username
   *
   * @param  string $username the username
   * @return self for PHP Method Chaining
   */
  public function setUsername($username) {
    $this->username = $username;
    return $this;
  }

  /**
   * Returns the first name
   *
   * @return string the first name
   */
  public function getFname() {
    return $this->fname;
  }

  /**
   * Sets the first name
   *
   * @param  string $fname the first name
   * @return self for PHP Method Chaining
   */
  public function setFname($fname) {
    $this->fname = $fname;
    return $this;
  }

  /**
   * Returns the last (family) name
   *
   * @return string the last (family) name
   */
  public function getLname() {
    return $this->lname;
  }

  /**
   * Sets the last (family) name
   *
   * @param  string $lname the last (family) name
   * @return self for PHP Method Chaining
   */
  public function setLname($lname) {
    $this->lname = $lname;
    return $this;
  }

  /**
   * Returns the email address
   *
   * @return string the email address
   */
  public function getEmail() {
    return $this->email;
  }

  /**
   * Sets the email address
   *
   * @param  string $email the email address
   * @return self for PHP Method Chaining
   */
  public function setEmail($email) {
    $this->email = $email;
    return $this;
  }

  /**
   * Returns the email address
   *
   * @return string the email address
   */
  public function getPhonenumbers() {
    return $this->phonenumbers;
  }

  /**
   * Sets the phonenumbers
   *
   * @param  string[] $phonenumbers the phonenumbers address
   * @return self for PHP Method Chaining
   */
  public function setPhonenumbers(array $phonenumbers = null) {
    if ($phonenumbers === null) {
      $phonenumbers = [];
    }
    $this->phonenumbers = $phonenumbers;
    return $this;
  }

  /**
   * Sets the email address
   *
   * @param  null|string $email the email address
   * @return self for PHP Method Chaining
   */
  public function addPhonenumber($phonenumber, $type = null) {
    if ($type !== null) {
      $this->phonenumbers[$type] = $phonenumber;
    } else {
      $this->phonenumbers[] = $phonenumber;
    }
    return $this;
  }

  /**
   * Returns the geographical address
   * 
   * @return Address the geographical address
   */
  public function getAddress() {
    return $this->address;
  }

  /**
   * Sets geographical address
   * 
   * @param  Address $address the geographical address
   * @return self for PHP Method Chaining
   */
  public function setAddress(Address $address = null) {
    if ($address === null) {
      $address = new Address();
    }
    $this->address = $address;
    return $this;
  }

  /**
   * Returns the permissions of the user
   *
   * @return BitMask the permissions of the user
   */
  public function getPermissions() {
    return $this->permissions;
  }

  /**
   * Sets the permissions of the user
   *
   * @param  null|scalar|BitMask $permissions the permissions of the user
   * @return self for PHP Method Chaining
   */
  public function setPermissions($permissions = 0) {
    $this->permissions = $permissions;
    return $this;
  }

  /**
   * Returns the hashed password of the user
   *
   * @return HashedPassword the hashed password of the user
   */
  public function getPassword() {
    return $this->password;
  }

  /**
   * Sets the hashed password of the user
   *
   * @param  null|string|Password|HashedPassword $password the password of the user
   * @return self for PHP Method Chaining
   */
  public function setPassword($password = "") {
    $this->password = new HashedPassword($password);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function fromArray(array $data = []) {
    $this->setPrimaryKey(Arrays::getValue($data, "id"))
            ->setUsername(Arrays::getValue($data, "username"))
            ->setFname(Arrays::getValue($data, "fname"))
            ->setLname(Arrays::getValue($data, "lname"))
            ->setEmail(Arrays::getValue($data, "email"))
            ->setPhonenumbers(Arrays::getValue($data, "phonenumbers"))
            ->setAddress(new Address($data))
            ->setPermissions(Arrays::getValue($data, "permissions"))
            ->setPassword(Arrays::getValue($data, "passworn"));
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getPrimaryKey() {
    return $this->id;
  }

  /**
   * {@inheritdoc}
   */
  public function setPrimaryKey($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function equals($object) { 
    $class= self::class;
    $result = false;
    if  ($object instanceof $class) {
      $result = $this->getUsername() == $object->getUsername() 
              && $this->getEmail() == $object->getEmail();
    }
    return $result;
  }

  /**
   * {@inheritdoc}
   */
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
