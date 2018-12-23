<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Sphp\Stdlib\Datastructures\Collection;
use Sphp\Database\Doctrine\Objects\Location;

/**
 * Implements a {@link Location} storage
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class LocationStorage extends AbstractObjectStorage implements \IteratorAggregate {

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
  public function findByName(string $name) {
    return $this->getRepository()->findOneBy(['name' => $name]);
  }

  /**
   * Tries to remove a location by its unique name
   *
   * @param  string $name the name of the location
   * @return Location|null  removed location or null if nothing was found
   */
  public function removeByName(string $name) {
    $obj = $this->findByName($name);
    if ($obj !== null) {
      $this->remove($obj);
    }
    return $obj;
  }

  /**
   * Finds all managed location objects that have the same country name
   * 
   * @param  string $country the name of the country
   * @param type $limit
   * @param type $offset
   * @return Location[] all managed objects that have the same country name
   */
  public function findByCountry(string $country, $limit = null, $offset = null): array {
    return $this->getRepository()->findBy(['address.country' => $country], ['name' => 'ASC'], $limit, $offset);
  }

  public function getIterator(): \Traversable {
    return new Collection($this->getRepository()->findBy([], ['name' => 'ASC']));
  }

  /**
   * Confirms the uniqueness of the location name in the repository
   *
   * @param  Location|string $needle the location instance or the location name string
   * @return boolean true, if location name is unique, false otherwise.
   */
  public function nameNotUsed($needle): bool {
    if ($needle instanceof Location) {
      $result = $needle->getName();
    }
    $query = $this->getManager()
            ->createQuery('SELECT COUNT(u.name) FROM ' . $this->getObjectType() . " u WHERE u.name = :name");
    $query->setParameter('name', $needle);
    $result = $query->getSingleScalarResult() == 0;

    return $result;
  }

}
