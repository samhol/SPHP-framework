<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Data;

use DateTimeInterface;
use DateTime;
use Sphp\Data\Address;

/**
 * Implements a person data object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Person extends AbstractDataObject {

  /**
   * The first name of the user
   *
   * @var string|null
   */
  private $fname;

  /**
   * The last name of the user
   * 
   * @var string|null
   */
  private $lname;

  /**
   * The last name of the user
   * 
   * @var DateTimeInterface|null
   */
  private $dob;

  /**
   * The geographical address of the user
   * 
   * @var Address|null
   */
  private $address;

  /**
   * the email address of the user
   * 
   * @var string|null
   */
  private $email;

  /**
   * @var string
   */
  private $phonenumber;

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
   * Returns the full name
   *
   * @return string the full name
   */
  public function getFullname(): string {
    if (!empty($this->fname) && !empty($this->lname)) {
      return "$this->fname $this->lname";
    } else {
      return "$this->fname$this->lname";
    }
  }

  public function getDateOfBirth() {
    return $this->dob;
  }

  public function setDateOfBirth(DateTimeInterface $dob = null) {
    $this->dob = $dob;
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
  public function setPhonenumber(string $phonenumber = null) {
    $this->phonenumber = $phonenumber;
    return $this;
  }

  /**
   * Returns the geographical address
   * 
   * @return Address|null the geographical address
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

  public function fromArray(array $raw) {
    $args = [
        'fname' => \FILTER_SANITIZE_STRING,
        'lname' => \FILTER_SANITIZE_STRING,
        'dob' => \FILTER_SANITIZE_STRING,
        'email' => \FILTER_SANITIZE_STRING,
        'phone' => \FILTER_SANITIZE_STRING,
    ];
    $person = filter_var_array($raw, $args, true);
    $this->setFname($person['fname'])
            ->setLname($person['lname'])
            ->setEmail($person['email'])
            ->setPhonenumber($person['phone']);
    if (isset($person['dob'])) {
      if (is_int($person['dob'])) {
        $dob = new DateTime();
        $dob->setTimestamp($person['dob']);
        $this->setDateOfBirth($dob);
      } else {
        $dob = DateTime::createFromFormat(DATE_ATOM, $person['dob']);
        if ($dob instanceof DateTimeInterface) {
          $this->setDateOfBirth($dob);
        }
      }
    } 
    if (isset($raw['address'])) {
      $this->setAddress(new Address($raw['address']));
    } else {
      $this->setAddress(new Address($raw));
    }
    
    return $this;
  }

  public function toArray(): array {
    $raw = get_object_vars($this);
    if ($raw['dob'] instanceof DateTimeInterface) {
      $raw['dob'] = $this->getDateOfBirth()->format(DATE_ATOM);
    }
    if ($raw['address'] instanceof Address) {
      $raw['address'] = $raw['address']->toArray();
    }
    return $raw;
  }

  /**
   * Serializes to string
   *
   * @return string the string representation of the object
   */
  public function __toString(): string {
    $output = "name: $this->fname $this->lname";
    $dob = ($this->dob instanceof \DateTimeInterface) ? $this->dob->format(DATE_ATOM) : '';
    $output .= "\ndate of birth: $dob";
    $output .= "\naddress: $this->address";
    $output .= "\nphonenumber: $this->phonenumber";
    $output .= "\nemail: $this->email";
    return $output;
  }

}
