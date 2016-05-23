<?php

/**
 * Address.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db\Objects;

use Sphp\Util\Arrays as Arrays;
use Doctrine\ORM\EntityManagerInterface as EntityManagerInterface;

/**
 * Class models a geographical address.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-03-08
 * @version 2.1.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 * @Entity
 * @Table(name="addresses")
 */
class Address extends AbstractDbObject {

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
    return $this->zipcode;
  }

  /**
   * Sets the zipcode
   *
   * @param  string|null $zipcode the zipcode
   * @return self for PHP Method Chaining
   */
  public function setZipcode($zipcode) {
    $this->zipcode = $zipcode;
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
   *
  public function toArray() {
    return [
        "street" => $this->getStreet(),
        "zipcode" => $this->getZipcode(),
        "city" => $this->getCity(),
        "country" => $this->getCountry(),
    ];
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

  /**
   * {@inheritdoc}
   */
  public function getPrimaryKey() {
    return $this->id;
  }

  /**
   * {@inheritdoc}
   */
  public function setPrimaryKey($id) {
    $this->id = $id;
    return $this;
  }
  
  /**
   * {@inheritdoc}
   */
  public function insertInto(EntityManagerInterface $em) {
    $em->persist($this);
    $em->flush();
  }

}
