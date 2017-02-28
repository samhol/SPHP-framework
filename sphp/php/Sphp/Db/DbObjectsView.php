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
abstract class DbObjectsView implements DBConnectorInterface, \Countable, \IteratorAggregate {

  use DBConnectorTrait;

  const DBID = DbObjectInterface::DBID;

  /**
   * the actual datatype of the DbObject
   *
   * @var string
   */
  private $objectType;

  /**
   * Constructs a new instance of the {@link self} object
   *
   * @param string|DbObjectInterface $dbObjectType object or object type
   * @param \PDO $pdo database connection
   */
  public function __construct($dbObjectType = DbObjectInterface::class, \PDO $pdo = null) {
    if ($pdo === null) {
      $this->obtainDefaultConnection();
    } else {
      $this->setConnection($pdo);
    }
    $this->setObjectType($dbObjectType);
  }

  /**
   * Returns the query object suitable for {@link DbObjectInterface} queries
   *
   * @return Query new database query object for {@link DbObjectInterface} queries
   */
  abstract public function query();

  /**
   * Sets the type of the stored objects in the database view
   *
   * @param  string|DbObjectInterface $type the type of the objects
   * @return self for a fluent interface
   * @throwa \InvalidArgumentException if the type does not implement {@link DbObjectInterface}
   */
  protected function setObjectType($type) {
    if (is_object($type)) {
      $objectType = get_class($type);
    } else {
      $objectType = $type;
    }
    if (!is_subclass_of($objectType, DbObjectInterface::class)) {
      throw new \InvalidArgumentException("Argument must implement " . DbObjectInterface::class . " not $type");
    }
    $this->objectType = $objectType;
    return $this;
  }

  /**
   * Sets the type of the stored objects in the database view
   *
   * @return  string the type of the stored objects
   */
  public function getObjectType() {
    return $this->objectType;
  }

  /**
   * Returns the first matching oject from the database view
   *
   * @param  null|Query $q 
   * @return null|DbObjectInterface the first matching oject from the database view
   */
  public function getFirst(Query $q = null) {
    $result = null;
    if ($q === null) {
      $q = $this->query();
    }
    $q->limit(1);
    //echo $q;
    $arr = $this->get($q);
    //print_r($arr);
    if (count($arr) >= 1) {
      $result = reset($arr);
    }
    return $result;
  }

  /**
   * Returns the first match of the DbItem from the database
   *
   * @param  DbObject|string|int $itemOrItemId DbItem or a id
   * @return DbItem corresponding object or null if nothing was found
   */
  public function getById($itemOrItemId) {
    $c = get_called_class();
    if ($itemOrItemId === null || $itemOrItemId == "") {
      return null;
    } else if ($itemOrItemId instanceof DbObjectInterface) {
      $itemOrItemId = $itemOrItemId->getPrimaryKey();
    }
    return $this->getFirst(Condition::equals($c::DBID, $itemOrItemId));
  }

  /**
   * Returns the queried objects from the database
   *
   * @param  null|Query $query the SQL query object
   * @return DbObjectInterface[] the result objets
   */
  public function get(Query $query = null) {
    $arr = [];
    if ($query === null) {
      $query = $this->query();
    }
    $objectType = $this->objectType;
    foreach ($query->fetchArray() as $row) {
      $arr[] = new $objectType($row);
    }
    return $arr;
  }

  /**
   * Counts the number of the objects in the queried view
   *
   * @param  null|Query $query the SQL query object
   * @return int the number of the objects
   */
  public function count(Query $query = null) {
    if ($query === null) {
      $query = $this->query();
    }
    return $query->count();
  }

  /**
   * Checks whether the given object(s) exists in the database
   *
   * @param  DbObjectInterface|DbObjectInterface[] $objects the object to serch for
   * @return boolean true if the object exists in the database, false otherwise
   */
  public function exists(DbObjectInterface $objects) {
    foreach (is_array($objects) ? $objects : [$objects] as $object) {
      if (!$object->contains()) {
        return false;
      }
    }
    return true;
  }

  /**
   * Replaces the given object(s) in the database view
   *
   * @param  DbObjectInterface|DbObjectInterface[] $objects the objects to replace
   * @return boolean true if the update was succesfull and false otherwise
   * @throws \InvalidArgumentException if the type of the object is not valid
   */
  public function upload($objects) {
    $replaced = 0;
    foreach (is_array($objects) ? $objects : [$objects] as $object) {
      if ($object->update()) {
        $replaced += 1;
      }
    }
    return $replaced;
  }

  /**
   * Removes the object from the database
   *
   * @param  DbObjectInterface|DbObjectInterface[] $objects the objects to delete
   * @return int the number of the removed objects
   * @throws \InvalidArgumentException if the type of the object is not valid
   */
  public function delete($objects) {
    $removed = 0;
    foreach (is_array($objects) ? $objects : [$objects] as $object) {
      if ($object->remove()) {
        $removed += 1;
      }
    }
    return $removed;
  }

  /**
   * Retrieve an external iterator
   *
   * @param  null|Query $query conditions or the entire Select SQL query
   * @return \ArrayIterator <T implements DbItem> the result objets
   */
  public function getIterator(Query $query = null) {
    return new \ArrayIterator($this->get($query));
  }

  /**
   * Checks whether database contains objects with specified properties 
   *
   * @param  array $what the properties used to limit the results
   * @return boolean true if the object exists in the database, false otherwise
   */
  public function contains(array $what) {
    $query = $this->query();
    $query->where()->equals($what);
    return $query->count() > 0;
  }

  /**
   * Returns all the objects with specified properties from the database
   *
   * @param  array $what the properties used to limit the results
   * @return DbObjectInterface[] the objects with specified properties found
   */
  public function find(array $what) {
    $query = $this->query();
    $query->where()->equals($what);
    return $this->get($query);
  }

}
