<?php

/**
 * LocationStorage.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Sphp\Stdlib\Datastructures\Collection;

/**
 * Implements a {@link Location} storage
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-05-20
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class LocationStorage extends AbstractObjectStorage {

  /**
   * Constructor
   *
   * @param EntityManagerInterface $em
   */
  public function __construct(EntityManagerInterface $em = null) {
    parent::__construct(Location::class, $em);
  }

  /**
   * Tries to get a location by its unique name
   *
   * @param  string $name the name of the searched location
   * @return Location|null  the location or null if nothing was found
   */
  public function findByName($name) {
    if ($name instanceof Location) {
      $name = $name->getName();
    }
    return $this->getRepository()->findOneBy(['name' => $name]);
  }

  /**
   * Tries to get a location by its unique name
   *
   * @param  string $name the name of the searched location
   * @return Location|null  the location or null if nothing was found
   */
  public function removeByName($name) {
    $obj = $this->findByName($name);
    if ($obj !== null) {
      $this->getManager()->remove($obj);
      $this->getManager()->flush();
    }
    return $this;
  }

  /**
   * Finds all managed location objects that have the same country name
   * 
   * @param  string $country the name of the country
   * @return Location[] all managed objects that have the same country name
   */
  public function findByCountry($country, array $orderBy = null, $limit = null, $offset = null) {
    return $this->findBy(['address.country' => $country], $orderBy, $limit, $offset);
  }

  public function getIterator() {
    return new Collection($this->getRepository()->findBy([], ['name' => 'ASC']));
  }

  /**
   * Confirms the uniqueness of the location name in the repository
   *
   * @param  Location|string $needle the location instance or the location name string
   * @return boolean true, if location name is unique, false otherwise.
   */
  public function nameNotUsed($needle) {
    if ($needle instanceof Location) {
      $result = $needle->getName();
    }
    $query = $this->getManager()
            ->createQuery('SELECT COUNT(u.name) FROM ' . $this->getObjectType() . " u WHERE u.name = :name");
    $query->setParameter('name', $needle);
    $result = $query->getSingleScalarResult() == 0;

    return $result;
  }

  public function exists(DbObjectInterface $id) {
    if ($id instanceof Location) {
      $username = $id->getName();
    }
    $query = $this->getManager()
            ->createQuery('SELECT COUNT(obj.id) FROM ' . $this->getObjectType() . " obj WHERE obj.name = :name");
    $query->setParameter('name', $username);
    return $query->getSingleScalarResult() == 1;
  }

}
