<?php

/**
 * GeographicalAddressInterfaces.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database\Doctrine\Objects;

/**
 * Defines properties for a geographical address
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface GeographicalAddress {

  /**
   * Returns the street address
   *
   * @return string the street address
   */
  public function getStreet();

  /**
   * Sets the street address
   *
   * @param  string $streetaddress the street address
   * @return $this for a fluent interface
   */
  public function setStreet(string $streetaddress = null);

  /**
   * Returns the zipcode
   *
   * @return string|null the zipcode
   */
  public function getZipcode();

  /**
   * Sets the zipcode
   *
   * @param  string|null $zipcode the zipcode
   * @return $this for a fluent interface
   */
  public function setZipcode(string $zipcode = null);

  /**
   * Returns the city or the district name
   *
   * @return string|null the city or the district name
   */
  public function getCity();

  /**
   * Sets the city or the district name
   *
   * @param  string|null $city the city or the district name
   * @return $this for a fluent interface
   */
  public function setCity(string $city = null);

  /**
   * Returns the country name
   *
   * @return string the country name
   */
  public function getCountry();

  /**
   * Sets the the country name
   *
   * @param  string $country the country name
   * @return $this for a fluent interface
   */
  public function setCountry(string $country = null);

  /**
   * Returns the maplink pointing to the location
   *
   * @return string the maplink pointing to the location
   */
  public function getMaplink();

  /**
   * Sets the maplink to the location
   *
   * @param  string $maplink the maplink to the location
   * @return $this for a fluent interface
   */
  public function setMaplink(string $maplink = null);
}
