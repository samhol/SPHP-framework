<?php

/**
 * Db.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

use PDO;
use Sphp\Exceptions\BadMethodCallException;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Implements a Database 
 *  
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

  public function getPdo(): PDO {
    return $this->pdo;
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
  public static function instance(string $name = null): Db {
    if ($name === null) {
      $name = 0;
    }
    if (!array_key_exists($name, self::$instances)) {
      throw new InvalidArgumentException("DB with name '$name' does not exist");
    }
    return self::$instances[$name];
  }

  /**
   * 
   * 
   * @param  string $name
   * @param type $arguments
   * @return type
   */
  public static function __callStatic(string $name, array $arguments = []) {
    if (count($arguments) > 0) {
      $instance = static::instance($arguments[0]);
    } else {
      $instance = static::instance();
    }
    return $instance->$name();
  }

  /**
   * 
   *
   * @method Query query(string $dbName) Returns a new query object for the named database
   * @method Delete delete(string $dbName)
   * @method Update update(string $dbName) Returns a new query object for the named database
   * @method Insert insert(string $dbName)
   * 
   * @param string $name
   * @param type $arguments
   * @return \Sphp\Database\Delete|\Sphp\Database\Insert|\Sphp\Database\Query|\Sphp\Database\Update
   * @throws \Sphp\Exceptions\BadMethodCallException
   */
  public function __call(string $name, array $arguments = []) {
    if ($name === 'query') {
      return new Query($this->pdo);
    } else if ($name === 'delete') {
      return new Delete($this->pdo);
    } else if ($name === 'insert') {
      return new Insert($this->pdo);
    } else if ($name === 'update') {
      return new Update($this->pdo);
    } else {
      throw new BadMethodCallException("Method $name does not exist in " . static::class);
    }
  }

}
