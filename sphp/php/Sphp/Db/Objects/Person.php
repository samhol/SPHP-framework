<?php

/**
 * User.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db\Objects;

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
class Person extends AbstractDbObject {

  /**
   * primary database key
   *
   * @var int 
   * @Id @Column(type="integer")
   * @GeneratedValue
   */
  private $id;

  /**
   *
   * @var SessionUser 
   */
  private $sessionUser;

  /**
   * The first name of the user
   *
   * @var string 
   * @Column(length=255)
   */
  private $fname;

  /**
   * The last name of the user
   * 
   * @var string 
   * @Column(length=255)
   */
  private $lname;

  /**
   * @var Address
   * @Embedded(class = "Address", columnPrefix = "home_") 
   */
  private $address;

  /**
   * 
   * @var string[]
   * @Column(type="simple_array")
   */
  private $phonenumbers = [];

  public function __construct($data = []) {
    parent::__construct($data);
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
    $this->address = $address;
    return $this;
  }

  public function fromArray(array $data = []) {
    $args = [
        'id' => \FILTER_VALIDATE_INT,
        'fname' => \FILTER_SANITIZE_STRING,
        'lname' => \FILTER_SANITIZE_STRING,
        'email' => \FILTER_SANITIZE_STRING,
        'phonenumbers' => \FILTER_REQUIRE_ARRAY,
        'emails' => \FILTER_REQUIRE_ARRAY
    ];
    $myinputs = filter_var_array($data, $args, true);
    $this->setPrimaryKey($myinputs['id'])
            ->setFname($myinputs['fname'])
            ->setLname($myinputs['lname'])
            ->setEmail($myinputs['emails'])
            ->setPhonenumbers($myinputs['phonenumbers'])
            ->setAddress(new Address($data));
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

  public function toArray() {
    $raw = get_object_vars($this);
    $result = [];
    foreach ($raw as $prop => $val) {
      if ($val instanceof DbObjectInterface) {
        $result[$prop] = $val->toArray();
      }
      if ($val instanceof ArrayableObjectInterface) {
        $result = array_merge($result, $val->toArray());
      } else {
        $result[$prop] = $val;
      }
    }
    return $result;
  }

}
