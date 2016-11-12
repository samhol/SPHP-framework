<?php

/**
 * UserTable.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db\Objects;

use Doctrine\ORM\EntityManagerInterface;

/**
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-05-20
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Locations extends AbstractObjectStorage {

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
   * Finds all managed location objects that have the same country name
   * 
   * @param  string $country the name of the country
   * @return Location[] all managed objects that have the same country name
   */
  public function findAllByCountry($country) {
    return $this->findByProperty("country", $country);
  }

  /**
   * Confirms the uniqueness of the location name in the repository
   *
   * @param  Location|string $needle the location instance or the location name string
   * @return boolean true, if location name is unique, false otherwise.
   */
  public function uniqueName($needle) {
    $result = false;
    if ($needle instanceof Location) {
      $result = $needle->usernameTaken($this->getManager());
    } else {
      $query = $this->getManager()
              ->createQuery('SELECT COUNT(u.id) FROM ' . $this->getObjectType() . " u WHERE u.name = :name");
      $query->setParameter('name', $needle);
      $result = $query->getSingleScalarResult() == 0;
    }
    return $result;
  }

  /**
   * Confirms the uniqueness of the location name in the repository
   *
   * @param  Location|string $needle the location instance or the location name string
   * @return boolean true, if location name is unique, false otherwise.
   */
  public function findLocation($needle) {
    $result = false;
    if ($needle instanceof Location) {
      $result = $needle->usernameTaken($this->getManager());
    } else {
      $query = $this->getManager()
              ->createQuery('SELECT COUNT(u.id) FROM ' . $this->getObjectType() . " u WHERE u.name = :name");
      $query->setParameter('name', $needle);
      $result = $query->getSingleScalarResult() == 0;
    }
    return $result;
  }

}
