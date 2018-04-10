<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database\Doctrine\Objects;

/**
 * Implements a geographical address
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 * @Embeddable
 */
class Address extends AbstractArrayableObject implements GeographicalAddress {

  /**
   * @var string|null
   * @Column(type = "string") 
   */
  private $street;

  /**
   * @var string|null
   * @Column(type = "string") 
   */
  private $zipcode;

  /**
   *
   * @var string|null
   * @Column(type = "string") 
   */
  private $city;

  /**
   * @var string|null
   * @Column(type = "string") 
   */
  private $country;

  /**
   * @var string|null
   * @Column(type = "string") 
   */
  private $maplink;

  public function getStreet() {
    return $this->street;
  }

  public function setStreet(string $streetaddress = null) {
    $this->street = $streetaddress;
    return $this;
  }

  public function getZipcode() {
    return $this->zipcode;
  }

  public function setZipcode(string $zipcode = null) {
    $this->zipcode = $zipcode;
    return $this;
  }

  public function getCity() {
    return $this->city;
  }

  public function setCity(string $city = null) {
    $this->city = $city;
    return $this;
  }

  public function getCountry() {
    return $this->country;
  }

  public function setCountry(string $country = null) {
    $this->country = $country;
    return $this;
  }

  public function getMaplink() {
    return $this->maplink;
  }

  public function setMaplink(string $maplink = null) {
    $this->maplink = $maplink;
    return $this;
  }

  public function fromArray(array $data = []) {
    foreach (get_object_vars($this) as $attrName => $attrValue) {
      if (array_key_exists($attrName, $data)) {
        $this->{$attrName} = $data[$attrName];
      }
    }
    return $this;
  }

  public function toArray(): array {
    return get_object_vars($this);
  }

  /**
   * Returns the string representation of the object
   *
   * @return string the string representation of the object
   */
  public function __toString(): string {
    $address = $this->getStreet();
    $address .= " " . $this->getZipcode();
    $address .= " " . $this->getCity();
    $address .= " " . $this->getCountry();
    return $address;
  }

  public function equals($object) {
    return $object == $this;
  }

}
