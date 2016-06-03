<?php

/**
 * DbObjectsView.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db;

use Sphp\Objects\DbObjectInterface as DbObjectInterface;

/**
 * Class manipulates {@link DbObjectIterface} instances stored in the database
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-11-23
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface DbObjectsStorage extends DBConnectorInterface, \Countable, \IteratorAggregate {

  /**
   * Returns the first matching oject from the database view
   *
   * @param  null|Query $q 
   * @return null|DbObjectInterface the first matching oject from the database view
   */
  public function getFirst(array $what);

  /**
   * Returns the first match of the DbItem from the database
   *
   * @param  DbObject|string|int $itemOrItemId DbItem or a id
   * @return DbItem corresponding object or null if nothing was found
   */
  public function getById($itemOrItemId);

  /**
   * Returns the queried objects from the database
   *
   * @param  null|Query $query the SQL query object
   * @return DbObjectInterface[] the result objets
   */
  public function get(array $what);

  /**
   * Counts the number of the objects in the queried view
   *
   * @param  null|Query $query the SQL query object
   * @return int the number of the objects
   */
  public function count(array $what);

  /**
   * Checks whether the given object(s) exists in the database
   *
   * @param  DbObjectInterface $object the object to serch for
   * @return boolean true if the object exists in the database, false otherwise
   */
  public function exists(DbObjectInterface $object);

  /**
   * Replaces the given object(s) in the database view
   *
   * @param  DbObjectInterface|DbObjectInterface[] $objects the objects to replace
   * @return boolean true if the update was succesfull and false otherwise
   * @throws \InvalidArgumentException if the type of the object is not valid
   */
  public function upload($objects);

  /**
   * Removes the object from the database
   *
   * @param  DbObjectInterface|DbObjectInterface[] $objects the objects to delete
   * @return int the number of the removed objects
   * @throws \InvalidArgumentException if the type of the object is not valid
   */
  public function delete($objects);

  /**
   * Retrieve an external iterator
   *
   * @param  array $what the properties used to limit the results
   * @return \ArrayIterator the result objets
   */
  public function getIterator(array $what);

  /**
   * Checks whether database contains objects with specified properties 
   *
   * @param  array $what the properties used to limit the results
   * @return boolean true if the object exists in the database, false otherwise
   */
  public function contains(array $what);

  /**
   * Returns all the objects with specified properties from the database
   *
   * @param  array $what the properties used to limit the results
   * @return DbObjectInterface[] the objects with specified properties found
   */
  public function find(array $what);
}
