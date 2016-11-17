<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Db\Objects;

/**
 * Defines properties for a geographical address
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-05-20
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface GeographicalAddressInterface {

  /**
   * Returns the streetaddress
   *
   * @return string the streetaddress
   */
  public function getStreet();

  /**
   * Sets the streetaddress
   *
   * @param  string $streetaddress the streetaddress
   * @return self for PHP Method Chaining
   */
  public function setStreet($streetaddress);

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
   * @return self for PHP Method Chaining
   */
  public function setZipcode($zipcode);

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
   * @return self for PHP Method Chaining
   */
  public function setCity($city);

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
   * @return self for PHP Method Chaining
   */
  public function setCountry($country);

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
   * @return self for PHP Method Chaining
   */
  public function setMaplink($maplink);
}
