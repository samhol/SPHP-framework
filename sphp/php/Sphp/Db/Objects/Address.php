<?php

/**
 * Address.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db\Objects;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Class models a geographical address.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-03-08
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 * @Entity
 * @Table(name="addresses")
 */
class Address extends AbstractDbObject implements GeographicalAddressInterface {

  use \Sphp\Objects\ToArrayTrait;

  /**
   *
   * @Id @Column(type="integer")
   * @GeneratedValue
   */
  private $id;

  /**
   *
   * @var string|null
   * @Column(length=100)
   */
  private $street;

  /**
   *
   * @var string|null
   * @Column(length=30)
   */
  private $zipcode;

  /**
   *
   * @var string|null
   * @Column(length=50)
   */
  private $city;

  /**
   *
   * @var string|null
   * @Column(length=50)
   */
  private $country;

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

  public function fromArray(array $data = []) {
    $args = [
        'id' => \FILTER_VALIDATE_INT,
        'street' => \FILTER_SANITIZE_STRING,
        'zipcode' => \FILTER_SANITIZE_STRING,
        'city' => \FILTER_SANITIZE_STRING,
        'country' => \FILTER_SANITIZE_STRING
    ];
    $myinputs = filter_var_array($data, $args, true);
    $this->setPrimaryKey($myinputs['id']);
    return $this->setStreet($myinputs['street'])
                    ->setZipcode($myinputs['zipcode'])
                    ->setCity($myinputs['city'])
                    ->setCountry($myinputs['country']);
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

  public function getPrimaryKey() {
    return $this->id;
  }

  public function setPrimaryKey($id) {
    $this->id = $id;
    return $this;
  }

  public function insertInto(EntityManagerInterface $em) {
    $em->persist($this);
    $em->flush();
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

}
