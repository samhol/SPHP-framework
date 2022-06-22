<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Data\Geographical;

use Sphp\Stdlib\Strings;

/**
 * Implements a geographical address
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Address {

  protected ?string $streetAddress;
  protected ?string $zipcode;
  protected ?string $city;
  protected ?string $country;

  public function __construct(array $data = []) {
    $this->streetAddress = $data['streetAddress'] ?? null;
    $this->zipcode = $data['zipcode'] ?? null;
    $this->city = $data['city'] ?? null;
    $this->country = $data['country'] ?? null;
  }

  public function setStreetAddress(?string $streetAddress): void {
    $this->streetAddress = $streetAddress;
  }

  public function setZipcode(?string $zipcode): void {
    $this->zipcode = $zipcode;
  }

  public function setCity(?string $city): void {
    $this->city = $city;
  }

  public function setCountry(?string $country): void {
    $this->country = $country;
  }

  public function getStreetAddress(): ?string {
    return $this->streetAddress;
  }

  public function getZipcode(): ?string {
    return $this->zipcode;
  }

  public function getCity(): ?string {
    return $this->city;
  }

  public function getCountry(): ?string {
    return $this->country;
  }

  public function fromArray(array $raw = []) {
    $args = [
        'street' => \FILTER_SANITIZE_STRING,
        'zip' => \FILTER_SANITIZE_STRING,
        'city' => \FILTER_SANITIZE_STRING,
        'country' => \FILTER_SANITIZE_STRING,
    ];
    $address = filter_var_array($raw, $args, true);
    $this->setStreet($address['street']);
    $this->setZipcode($address['zip']);
    $this->setCity($address['city']);
    $this->setCountry($address['country']);

    return $this;
  }

  public function toArray(): array {
    return get_object_vars($this);
  }

  /**
   * Serializes to string
   *
   * @return string the string representation of the object
   */
  public function __toString(): string {
    $output = '';
    if ($this->street != '' && !Strings::isEmpty($this->street)) {
      $output .= $this->street;
    }
    if ($this->zipcode != '' && !Strings::isEmpty($this->zipcode)) {
      $output .= ", $this->zipcode";
    }
    if ($this->city != '' && !Strings::isEmpty($this->city)) {
      $output .= " $this->city";
    }
    if ($this->country != '' && !Strings::isEmpty($this->country)) {
      $output .= ", $this->country";
    }
    return $output;
  }

}
