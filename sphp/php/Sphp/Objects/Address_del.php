<?php

/**
 * Address.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Objects;

use Sphp\Core\Types\Arrays as Arrays;

/**
 * Class models a geographical address.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-03-08
 * @version 2.1.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Address extends AbstractArrayableObject {

  use EqualsTrait;

  /**
   *
   * @var string|null
   */
  private $street, $zip, $city, $country;

  /**
   * Returns the streetaddress
   *
   * @return string the streetaddress
   */
  public function getStreet() {
    return $this->street;
  }

  /**
   * Sets the streetaddress
   *
   * @param  string $streetaddress the streetaddress
   * @return self for PHP Method Chaining
   */
  public function setStreet($streetaddress) {
    $this->street = $streetaddress;
    return $this;
  }

  /**
   * Returns the zipcode
   *
   * @return string|null the zipcode
   */
  public function getZipcode() {
    return $this->zip;
  }

  /**
   * Sets the zipcode
   *
   * @param  string|null $zipcode the zipcode
   * @return self for PHP Method Chaining
   */
  public function setZipcode($zipcode) {
    $this->zip = $zipcode;
    return $this;
  }

  /**
   * Returns the city or the district name
   *
   * @return string|null the city or the district name
   */
  public function getCity() {
    return $this->city;
  }

  /**
   * Sets the city or the district name
   *
   * @param  string|null $city the city or the district name
   * @return self for PHP Method Chaining
   */
  public function setCity($city) {
    $this->city = $city;
    return $this;
  }

  /**
   * Returns the country name
   *
   * @return string the country name
   */
  public function getCountry() {
    return $this->country;
  }

  /**
   * Sets the the country name
   *
   * @param  string $country the country name
   * @return self for PHP Method Chaining
   */
  public function setCountry($country) {
    $this->country = $country;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function fromArray(array $data = []) {
    return $this->setStreet(Arrays::getValue($data, "street"))
                    ->setZipcode(Arrays::getValue($data, "zipcode"))
                    ->setCity(Arrays::getValue($data, "city"))
                    ->setCountry(Arrays::getValue($data, "country"));
  }

  /**
   * {@inheritdoc}
   */
  public function toArray() {
    return get_object_vars($this);
  }

  /**
   * Returns the string representation of the object
   *
   * @return string the string representation of the object
   */
  public function __toString() {
    $address = $this->getStreet();
    $address .= " " . $this->getZipcode();
    $address .= " " . $this->getCity();
    $address .= " " . $this->getCountry();
    return $address;
  }

}
