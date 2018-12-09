<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Data;

use Sphp\Stdlib\Strings;

/**
 * Implements a geographical address
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Address extends AbstractDataObject implements GeographicalAddress {

  /**
   * @var string|null
   */
  protected $street;

  /**
   * @var string|null
   */
  protected $zipcode;

  /**
   *
   * @var string|null
   */
  protected $city;

  /**
   * @var string|null
   */
  protected $country;

  /**
   * @var string|null
   */
  protected $maplinks = [];

  public function getStreet() {
    return (string) $this->street;
  }

  /**
   * Sets the street address
   *
   * @param  string $streetaddress the street address
   * @return $this for a fluent interface
   */
  public function setStreet(string $streetaddress = null) {
    $this->street = $streetaddress;
    return $this;
  }

  public function getZipcode(): string {
    return (string) $this->zipcode;
  }

  /**
   * Sets the zipcode
   *
   * @param  string|null $zipcode the zipcode
   * @return $this for a fluent interface
   */
  public function setZipcode(string $zipcode = null) {
    $this->zipcode = $zipcode;
    return $this;
  }

  public function getCity(): string {
    return (string) $this->city;
  }

  /**
   * Sets the city or the district name
   *
   * @param  string|null $city the city or the district name
   * @return $this for a fluent interface
   */
  public function setCity(string $city = null) {
    $this->city = $city;
    return $this;
  }

  public function getCountry(): string {
    return (string) $this->country;
  }

  /**
   * Sets the the country name
   *
   * @param  string|null $country the country name
   * @return $this for a fluent interface
   */
  public function setCountry(string $country = null) {
    $this->country = $country;
    return $this;
  }

  public function getMaplinks(): array {
    return $this->maplinks;
  }

  /**
   * Sets the map links
   *
   * @param  array $maplinks map links
   * @return $this for a fluent interface
   */
  public function setMaplinks(array $maplinks = []) {
    $this->maplinks = $maplinks;
    return $this;
  }

  public function fromArray(array $raw = []) {
    $args = [
        'street' => \FILTER_SANITIZE_STRING,
        'zip' => \FILTER_SANITIZE_STRING,
        'city' => \FILTER_SANITIZE_STRING,
        'country' => \FILTER_SANITIZE_STRING,
        'maplinks' => [
            'filter' => FILTER_REQUIRE_ARRAY,
            'flags' => FILTER_FORCE_ARRAY,
        ]
    ];
    $address = filter_var_array($raw, $args, true);
    $this->setStreet($address['street']);
    $this->setZipcode($address['zip']);
    $this->setCity($address['city']);
    $this->setCountry($address['country']);
    if ($address['maplinks'] !== null) {
      $this->setMaplinks($address['maplinks']);
    }
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

  public function equals($object) {
    return $object == $this;
  }

}
