<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database\Doctrine;

use Exception;
use Traversable;
use Countable;
use Sphp\Database\Doctrine\Objects\DbObjectInterface;

/**
 * Defines required properties for a {@link DbObjectInterface} storage
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface ObjectStorageInterface extends Traversable, Countable {

  /**
   * 
   * @return string
   */
  public function getObjectType(): string;

  /**
   * Finds entities by a single criteria
   * 
   * @param string $prop property name
   * @param mixed $value property value
   * @param array|null $orderBy
   * @param int|null $limit
   * @param int|null $offset
   * @return DbObjectInterface[] an array of matching objects
   * @throws Exception if anything fails
   */
  public function findByProperty($prop, $value);

  /**
   * Finds entities by a set of criteria
   * 
   * @param array $criteria a set of criteria
   * @param array|null $orderBy
   * @param int|null $limit
   * @param int|null $offset
   * @throws Exception if anything fails
   */
  public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);

  /**
   * 
   * @return Traversable
   */
  public function getIterator(): \Traversable;


  /**
   * 
   * @param  mixed $id
   * @return boolean
   */
  public function exists(DbObjectInterface $id): bool;

  /**
   * 
   * @param DbObjectInterface $object
   */
  public function insertAsNew(DbObjectInterface $object);

  /**
   * Merges an entity to the repository
   * 
   * @param  DbObjectInterface $object
   * @return DbObjectInterface the merged object
   */
  public function merge(DbObjectInterface $object);

  /**
   * 
   * @param  DbObjectInterface $object
   * @return boolean
   */
  public function contains(DbObjectInterface $object): bool;
}
