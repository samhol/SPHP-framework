<?php

/**
 * Db.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

use PDO;

/**
 * Implements a Database 
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Db {

  /**
   *
   * @var Db 
   */
  private static $instances = [];

  /**
   * @var PDO 
   */
  private $pdo;

  /**
   * Constructs a new instance
   *
   * @param  PDO $pdo the database connection
   * @link   http://www.php.net/manual/en/book.pdo.php PHP Data Objects
   */
  public function __construct(PDO $pdo = null) {
    $this->pdo = $pdo;
  }

  /**
   *
   * @return Query new instance of the database querier
   */
  public function getQuery() {
    return new Query($this->pdo);
  }

  /**
   *
   * @param  string $table optional table name
   * @param  mixed $values
   * @return Insert new instance of the database inserter
   */
  public function insert($table = null, $values = null) {
    $insert = new Insert($this->pdo);
    if ($table !== null) {
      $insert->table($table);
    }
    if ($values !== null) {
      $insert->values($values);
    }
    return $insert;
  }

  /**
   * Returns a new instance of the database updater
   *
   * @param  string|null $table optional relation name
   * @param  string|Conditions|null $where
   * @return Update new instance of the database updater
   */
  public function update($table = null, $where = null) {
    $update = new Update($this->pdo);
    if ($table !== null) {
      $update->table($table);
    }
    if ($where !== null) {
      if (is_string($where)) {
        $where = new Conditions($where);
      }
      $update->where($where);
    }
    return $update;
  }

  /**
   *
   * @param  string|null $from optional relation names
   * @param  string|Conditions|null $where
   * @return Delete
   */
  public function delete($from = null, $where = null) {
    $update = new Delete($this->pdo);
    if ($from !== null) {
      $update->from($from);
    }
    if ($where !== null) {
      if (is_string($where)) {
        $where = new Conditions($where);
      }
      $update->setConditions($where);
    }
    return $update;
  }

  /**
   * 
   * @param PDO $db
   * @param string $name
   */
  public static function createFrom(PDO $db, string $name = null) {
    $instance = new static($db);
    if ($name === null) {
      self::$instances[0] = $instance;
    } else {
      self::$instances[$name] = $instance;
    }
  }

  /**
   * 
   * @param string $name
   * @return Db
   * @throws \Sphp\Exceptions\InvalidArgumentException
   */
  public static function instance(string $name = null) {
    if ($name === null) {
      $name = 0;
    }
    if (!array_key_exists($name, self::$instances)) {
      throw new \Sphp\Exceptions\InvalidArgumentException("DB with name '$name' does not exist");
    }
    return self::$instances[$name];
  }

  public static function __callStatic($name, $arguments) {
    // Note: value of $name is case sensitive.

    echo "Calling static method '$name' "
    . implode(', ', $arguments) . "\n";

    if (count($arguments) > 0) {
      $instance = static::instance($arguments[0]);
    } else {
      $instance = static::instance();
    }
    return $instance->getQuery();
  }

  public function __call($name, $arguments) {
    // Note: value of $name is case sensitive.
    echo "Calling method '$name' "
    . implode(', ', $arguments) . "\n";

    return $this->getQuery();
  }

}
