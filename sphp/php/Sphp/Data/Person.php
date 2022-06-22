<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Data;

use Sphp\Data\Geographical\Address;
use Sphp\DateTime\Date;
use Sphp\DateTime\ImmutableDateTime;
use Sphp\Exceptions\InvalidStateException;
use Sphp\DateTime\Interval;

/**
 * Implements a person data object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Person {

  protected ?string $fname;
  protected ?string $lname;
  protected ?string $email;
  protected ?string $phone;
  protected Address $address;
  protected ?Date $dob = null;
  protected ?Date $dod = null;

  /**
   * Constructor
   * 
   * @param array $data
   */
  public function __construct(array $data = []) {
    $this->fname = $data['fname'] ?? null;
    $this->lname = $data['lname'] ?? null;
    $this->phone = $data['phone'] ?? null;
    $this->email = $data['email'] ?? null;
    if (array_key_exists('dob', $data)) {
      $this->dob = ImmutableDateTime::from($data['dod']);
    } if (array_key_exists('dod', $data)) {
      $this->dod = ImmutableDateTime::from($data['dod']);
    }
    $this->address = new Address($data);
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->address, $this->dob, $this->dod);
  }

  public function setFname(?string $fname): void {
    $this->fname = $fname;
  }

  public function setLname(?string $lname): void {
    $this->lname = $lname;
  }

  public function setEmail(?string $email): void {
    $this->email = $email;
  }

  public function setPhone(?string $phone): void {
    $this->phone = $phone;
  }

  public function setAddress(Address $address): void {
    $this->address = $address;
  }

  public function setDob(?Date $dob): void {
    $this->dob = $dob;
  }

  public function setDod(?Date $dod): void {
    $this->dod = $dod;
  }

  /**
   * Returns the first name
   *
   * @return string the first name
   */
  public function getFname(): ?string {
    return (string) $this->fname;
  }

  /**
   * Returns the last (family) name
   *
   * @return string the last (family) name
   */
  public function getLname(): ?string {
    return $this->lname;
  }

  /**
   * Returns the full name
   *
   * @return string the full name
   */
  public function getFullname(): string {
    return "$this->fname $this->lname";
  }

  /**
   * 
   * @return Date|null
   */
  public function getDateOfBirth(): ?Date {
    return $this->dob;
  }

  /**
   * 
   * @return Date|null
   */
  public function getDateOfDeath(): ?Date {
    return $this->dod;
  }

  public function isDead(): bool {
    return $this->dod !== null;
  }

  public function getAge($toDate = null): Interval {
    if ($this->dob === null) {
      throw new InvalidStateException('Date of birth is not defined');
    }
    if ($toDate === null) {
      $toDate = new \DateTimeImmutable('now');
    }
    if ($this->isDead() && $this->dod->compareTo($toDate) < 0) {
      return $this->dob->diff($this->dod);
    } else {
      return $this->dob->diff($toDate);
    }
  }

  /**
   * Returns the email address
   *
   * @return string the email address
   */
  public function getEmail(): ?string {
    return $this->email;
  }

  /**
   * Returns the email address
   *
   * @return string|null the email address
   */
  public function getPhonenumber(): ?string {
    return $this->phonenumber;
  }

  /**
   * Returns the geographical address
   * 
   * @return Address the geographical address
   */
  public function getAddress(): Address {
    return $this->address;
  }

  public static function fromArray(array $raw): Person {
    $args = [
        'fname' => \FILTER_SANITIZE_STRING,
        'lname' => \FILTER_SANITIZE_STRING,
        'dob' => \FILTER_SANITIZE_STRING,
        'email' => \FILTER_SANITIZE_STRING,
        'phone' => \FILTER_SANITIZE_STRING,
    ];
    $person = filter_var_array($raw, $args, true);
    $person->setFname($person['fname'])
            ->setLname($person['lname'])
            ->setEmail($person['email'])
            ->setPhonenumber($person['phone']);
    if (isset($person['dob'])) {
      if (is_int($person['dob'])) {
        $dob = new ImmutableDateTime();
        $dob->setTimestamp($person['dob']);
        $person->setDateOfBirth($dob);
      } else {
        $dob = ImmutableDateTime::createFromFormat(DATE_ATOM, $person['dob']);
        if ($dob instanceof DateTimeInterface) {
          $person->setDateOfBirth($dob);
        }
      }
    }
    if (isset($raw['address'])) {
      $person->setAddress(new Address($raw['address']));
    } else {
      $person->setAddress(new Address($raw));
    }

    return new Person($person);
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
    if ($this->dob !== null) {
      $output .= "\ndate of birth: " . $this->dob->format('Y-m-d');
    }
    if ($this->dod !== null) {
      $output .= "\ndate of death: " . $this->dod->format('Y-m-d');
    }
    $output .= "\naddress: $this->address";
    $output .= "\nphonenumber: $this->phonenumber";
    $output .= "\nemail: $this->email";
    return $output;
  }

}
