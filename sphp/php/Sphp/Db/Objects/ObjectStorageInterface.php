<?php

/**
 * ObjectStorageInterface.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db\Objects;

use Doctrine\ORM\EntityManagerInterface;
use Exception;
use IteratorAggregate;
use Countable;

/**
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-05-20
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ObjectStorageInterface extends IteratorAggregate, Countable {

  /**
   * 
   * @return EntityManagerInterface
   */
  public function getManager();

  /**
   * 
   * @return string
   */
  public function getObjectType();

  /**
   * 
   * @param  string $prop the name of the object property
   * @param  mixed $value the value of the object property
   * @return DbObjectInterface[] an array of matching objects
   * @throws Exception if anything fails
   */
  public function findByProperty($prop, $value);

  /**
   * 
   * @param  array $props the name of the object property
   * @return DbObjectInterface[] an array of matching objects
   * @throws Exception if anything fails
   */
  public function findBy(array $props);

  /**
   * 
   * @return ArrayIterator
   */
  public function getIterator();

  /**
   * Finds an Entity of {@link self::getObjectType()}-type by its identifier
   *
   * @param  mixed $id the 
   * @return DbObjectInterface|null
   */
  public function get($id);

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
  public function save(DbObjectInterface $object);

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
