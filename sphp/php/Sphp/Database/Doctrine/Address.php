<?php

/**
 * Address.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database\Doctrine;

use Sphp\Objects\AbstractArrayableObject;

/**
 * Implements a geographical address
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-03-08
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 * @Embeddable
 */
class Address extends AbstractArrayableObject implements GeographicalAddressInterface, Embeddable {

  /**
   *
   * @var string|null
   * @Column(type = "string") 
   */
  private $street;

  /**
   *
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
   *
   * @var string|null
   * @Column(type = "string") 
   */
  private $country;

  /**
   *
   * @var string|null
   * @Column(type = "string") 
   */
  private $maplink;

  public function getStreet() {
    return $this->street;
  }

  public function setStreet($streetaddress) {
    $this->street = $streetaddress;
    return $this;
  }

  public function getZipcode() {
    return $this->zipcode;
  }

  public function setZipcode($zipcode) {
    $this->zipcode = $zipcode;
    return $this;
  }

  public function getCity() {
    return $this->city;
  }

  public function setCity($city) {
    $this->city = $city;
    return $this;
  }

  public function getCountry() {
    return $this->country;
  }

  public function setCountry($country) {
    $this->country = $country;
    return $this;
  }

  public function getMaplink() {
    return $this->maplink;
  }

  public function setMaplink($maplink) {
    $this->maplink = $maplink;
    return $this;
  }

  public function fromArray(array $data = []) {
    $args = [
        'id' => \FILTER_VALIDATE_INT,
        'street' => \FILTER_SANITIZE_STRING,
        'zipcode' => \FILTER_SANITIZE_STRING,
        'city' => \FILTER_SANITIZE_STRING,
        'country' => \FILTER_SANITIZE_STRING,
        'maplink' => \FILTER_SANITIZE_STRING
    ];
    $myinputs = filter_var_array($data, $args, true);
    $this->setStreet($myinputs['street'])
            ->setZipcode($myinputs['zipcode'])
            ->setCity($myinputs['city'])
            ->setCountry($myinputs['country'])
            ->setMaplink($myinputs['maplink']);
    return $this;
  }

  public function toArray(): array {
    return [
        'street' => $this->getStreet(),
        'city' => $this->getCity(),
        'zipcode' => $this->getZipcode(),
        'country' => $this->getCountry(),
        'maplink' => $this->getMaplink()
    ];
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
