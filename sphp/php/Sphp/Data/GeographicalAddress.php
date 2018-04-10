<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Data;

/**
 * Defines properties for a geographical address
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
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
   * Returns the zipcode
   *
   * @return string|null the zipcode
   */
  public function getZipcode();

  /**
   * Returns the city or the district name
   *
   * @return string|null the city or the district name
   */
  public function getCity();

  /**
   * Returns the country name
   *
   * @return string the country name
   */
  public function getCountry();

  /**
   * Returns the map links pointing to the location
   *
   * @return array the map links pointing to the location
   */
  public function getMaplinks(): array;
}
