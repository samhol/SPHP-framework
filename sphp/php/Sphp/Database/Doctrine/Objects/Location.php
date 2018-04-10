<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database\Doctrine\Objects;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Implements a geographical location
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 * @Entity
 * @Table(name="locations",uniqueConstraints={@UniqueConstraint(name="unique_name", columns={"name"})})
 */
class Location extends AbstractArrayableObject {

  /**
   * @var string
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
  public function getName(): string {
    return (string) $this->name;
  }

  /**
   * Sets the name of the location
   *
   * @param  string $name the name of the location
   * @return $this for a fluent interface
   */
  public function setName(string $name = null) {
    $this->name = $name;
    return $this;
  }

  /**
   * Returns the full address as an object
   *
   * @return Address the full address
   */
  public function getAddress(): Address {
    return $this->address;
  }

  /**
   * Sets the address of the location
   *
   * @param  Address $address the address of the location
   * @return $this for a fluent interface
   */
  public function setAddress(Address $address) {
    $this->address = $address;
    return $this;
  }

  public function __toString(): string {
    $output = static::class . ":\n";
    foreach ($this->toArray() as $prop => $val) {
      if (is_array($val)) {
        $val = Arrays::implodeWithKeys($val, "\n\t\t", ": ");
      }
      $output .= "\t$prop: $val\n";
    }
    return $output;
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

  public function toArray(): array {
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
    } */
}
