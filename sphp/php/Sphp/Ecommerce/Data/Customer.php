<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Ecommerce\Data;

use Sphp\Data\Geographical\Address;

/**
 * The Customer class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Customer {

  protected ?string $fname;
  protected ?string $lname;
  protected ?string $email;
  protected ?string $phone;
  protected Address $address;

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
    $this->address = new Address($data);
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->address);
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
    return $this->phone;
  }

  /**
   * Returns the geographical address
   * 
   * @return Address the geographical address
   */
  public function getAddress(): Address {
    return $this->address;
  }

  public function toArray(): array {
    $raw = get_object_vars($this);

    if ($raw['address'] instanceof Address) {
      $raw['address'] = $raw['address']->toArray();
    }
    return $raw;
  }

}
