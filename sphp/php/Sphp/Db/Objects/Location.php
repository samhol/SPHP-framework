<?php

/**
 * Location.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db\Objects;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Implements a geographical location stored into a database
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @since   2016-05-20
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 * @Entity
 * @Table(name="locations",uniqueConstraints={@UniqueConstraint(name="unique_name", columns={"name"})})
 */
class Location extends AbstractDbObject implements GeographicalAddressInterface {

  /**
   *
   * @var string|null
   * @Id @Column(type="string")
   */
  private $name;

  /**
   * @var Address
   * @Embedded(class = "Address", columnPrefix = false) 
   */
  private $address;

  /**
   * Returns the name of the location
   *
   * @return string the name of the location
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Sets the name of the location
   *
   * @param  string $name  the name of the location
   * @return self for a fluent interface
   */
  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  /**
   * Returns the full address as an {@link Address} object
   *
   * @return Address the full address as an object
   */
  public function getAddress() {
    return $this->address;
  }

  /**
   * Sets the address of the location
   *
   * @param  Address $address the address of the location
   * @return self for a fluent interface
   */
  public function setAddress(Address $address) {
    $this->address = $address;
    return $this;
  }

  public function getStreet() {
    return $this->address->getStreet();
  }

  public function getCity() {
    return $this->address->getCity();
  }

  public function getZipcode() {
    return $this->address->getZipcode();
  }

  public function getCountry() {
    return $this->address->getCountry();
  }

  public function getMaplink() {
    return $this->address->getMaplink();
  }

  public function setStreet($streetaddress) {
    $this->address->setStreet($streetaddress);
    return $this;
  }

  public function setCity($city) {
    $this->address->setCity($city);
    return $this;
  }

  public function setZipcode($zipcode) {
    $this->address->setZipcode($zipcode);
    return $this;
  }

  public function setCountry($country) {
    $this->address->setCountry($country);
    return $this;
  }

  public function setMaplink($maplink) {
    $this->address->setMaplink($maplink);
    return $this;
  }

  public function fromArray(array $data = []) {
    $args = [
        'name' => \FILTER_SANITIZE_STRING
    ];
    $myinputs = filter_var_array($data, $args, true);
    $this->setName($myinputs['name'])
            ->setAddress(new Address($data));
    return $this;
  }

  public function toArray() {
    $data = [
        'name' => $this->getName()
    ];
    $addr = $this->address->toArray();
    return array_merge($data, $addr);
  }

  public function equals($object) {
    $class = static::class;
    $result = false;
    if ($object instanceof $class) {
      $result = $this->getName() == $object->getName() && $this->getAddress()->equals($object->getAddress());
    }
    return $result;
  }

  /**
   * Confirms the uniqueness of the location name in the repository
   *
   * @param  EntityManagerInterface $em the entity manager
   * @return boolean true, if location name is unique, false otherwise.
   */
  public function hasUniqueNameIn(EntityManagerInterface $em) {
    if ($this->isManagedBy($em)) {
      $query = $em->createQuery('SELECT COUNT(obj.name) FROM ' . self::class . ' obj WHERE obj.name = :name AND obj.id != :id');
      $query->setParameter("name", $this->getName());
      $query->setParameter("id", $this->getPrimaryKey());
    } else {
      $query = $em->createQuery('SELECT COUNT(obj.name) FROM ' . self::class . ' obj WHERE obj.name = :name');
      $query->setParameter("name", $this->getName());
    }
    $count = $query->getSingleScalarResult();
    return $count == 0;
  }

  public function insertAsNewInto(EntityManagerInterface $em) {
    if (!$this->isManagedBy($em) && $this->hasUniqueNameIn($em)) {
      $em->persist($this);
      $em->flush();
    } else {
      throw new \RuntimeException('Location cannot be inserted into the manager as a new instance');
    }
  }

}
