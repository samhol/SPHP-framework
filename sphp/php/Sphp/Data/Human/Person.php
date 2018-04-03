<?php

/**
 * Person.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Data\Human;

use Sphp\Data\Address;
use Sphp\Stdlib\Datastructures\Arrayable;

/**
 * Implements a system user
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Person implements Arrayable {

  /**
   * The first name of the user
   *
   * @var string 
   */
  private $fname;

  /**
   * The last name of the user
   * 
   * @var string 
   */
  private $lname;

  /**
   * The last name of the user
   * 
   * @var string 
   */
  private $dob;

  /**
   * The geographical address of the user
   * 
   * @var Address 
   */
  private $address;

  /**
   * the email address of the user
   * 
   * @var string
   */
  private $email;

  /**
   * @var string
   */
  private $phonenumber;

  public function __construct(array $data = []) {
    $this->fromArray($data);
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
   * @return $this for a fluent interface
   */
  public function setFname(string $fname = null) {
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
   * @return $this for a fluent interface
   */
  public function setLname(string $lname = null) {
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
   * @return $this for a fluent interface
   */
  public function setEmail(string $email = null) {
    $this->email = $email;
    return $this;
  }

  /**
   * Returns the email address
   *
   * @return string the email address
   */
  public function getPhonenumber() {
    return $this->phonenumber;
  }

  /**
   * Sets the phone number
   *
   * @param  string $phonenumber the phone number
   * @return $this for a fluent interface
   */
  public function setPhonenumbers(string $phonenumber = null) {
    $this->phonenumber = $phonenumber;
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
   * @param  Address|null $address optional geographical address
   * @return $this for a fluent interface
   */
  public function setAddress(Address $address = null) {
    $this->address = $address;
    return $this;
  }

  public function fromArray(array $raw = []) {
    $args = [
        'fname' => \FILTER_SANITIZE_STRING,
        'lname' => \FILTER_SANITIZE_STRING,
        'email' => \FILTER_SANITIZE_STRING,
        'phonenumber' => \FILTER_SANITIZE_STRING,
    ];
    $person = filter_var_array($raw, $args, true);
    //print_r($person);
    $this->setFname($person['fname'])
            ->setLname($person['lname'])
            ->setEmail($person['email'])
            ->setPhonenumbers($person['phonenumber'])
            ->setAddress(new Address($raw));
    return $this;
  }

  public function toArray(): array {
    $arr = get_object_vars($this);
    unset($arr['address']);
    if ($this->address !== null) {
      $arr = array_merge($arr, $this->address->toArray());
    }
    return $arr;
  }

}
