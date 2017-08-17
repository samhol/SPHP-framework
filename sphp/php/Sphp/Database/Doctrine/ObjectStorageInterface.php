<?php

/**
 * ObjectStorageInterface.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db\Objects;

use Exception;
use IteratorAggregate;
use Countable;

/**
 * Defines required properties for a {@link DbObjectInterface} storage
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-05-20
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ObjectStorageInterface extends IteratorAggregate, Countable {

  /**
   * 
   * @return string
   */
  public function getObjectType();

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
  public function getIterator();

  /**
   * Finds an Entity of {@link self::getObjectType()}-type by its identifier
   *
   * @param  mixed $id the 
   * @return DbObjectInterface|null
   */
  public function getById($id);

  /**
   * 
   * @param  mixed $id
   * @return boolean
   */
  public function exists(DbObjectInterface $id);

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
  public function contains(DbObjectInterface $object);
}
