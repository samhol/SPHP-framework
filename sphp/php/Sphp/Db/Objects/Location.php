<?php

/**
 * Location.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db\Objects;

use Sphp\Util\FileUtils as FileUtils;

/**
 * Class models a geographical location stored into a database
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @since   2016-05-20
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Location extends Address implements DbObjectInterface {


  const NAME = "name";
  const MAPLINK = "maplink";


  /**
   * Returns the name of the location
   *
   * @return the name of the location
   */
  public function getName() {
    return $this->get(self::NAME);
  }

  /**
   * Sets the name of the location
   *
   * @param  string $name  the name of the location
   * @return self for PHP Method Chaining
   */
  public function setName($name) {
    return $this->set(self::NAME, $name);
  }

  /**
   * Returns the maplink pointing to the location
   *
   * @return string the maplink pointing to the location
   */
  public function getMaplink() {
    return $this->get(self::MAPLINK);
  }

  /**
   * Sets the maplink to the location
   *
   * @param  string $maplink the maplink to the location
   * @return self for PHP Method Chaining
   */
  public function setMaplink($maplink) {
    return $this->set(self::MAPLINK, $maplink);
  }

  /**
   * Returns the full address as an {@link Address} object
   *
   * @return Address the full address as an object
   */
  public function getAddress() {
    return (new Address())
                    ->setStreetaddress($this->getStreetaddress())
                    ->setZipcode($this->getZipcode())
                    ->setCity($this->getCity())
                    ->setCountry($this->getCountry());
  }

  /**
   * Sets the address fields from the {@link Address} object
   *
   * @param  Address $addr the inserted address data
   * @return self for PHP Method Chaining
   */
  public function setAddress(Address $addr) {
    $this->setStreetaddress($addr->getStreetaddress())
            ->setZipcode($addr->getZipcode())
            ->setCity($addr->getCity())
            ->setCountry($addr->getCountry());
    return $this;
  }

  /**
   * Checks if the location has a working maplink or not
   *
   * @return boolean true if the location has a working maplink, false otherwise
   */
  public function hasMapLink() {
    return FileUtils::remoteFileExists($this->get(self::MAPLINK));
  }

  /**
   * Resets the data of the object
   *
   * @param  mixed[] $data raw source data
   * @return self for PHP Method Chaining
   */
  public function fromArray(array $data = []) {
    parent::fromArray($data);
    return $this->setPrimaryKey($data[self::DBID])
                    ->setName($data[Location::NAME])
                    ->setMaplink($data[Location::MAPLINK]);
  }

}
