<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database;

use PDO;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Exceptions\BadMethodCallException;

/**
 * Implements a Database statement factory
 *  
 * @method \Sphp\Database\Query query(string $dbName) Returns a new `SELECT` statement object for the named database
 * @method \Sphp\Database\Delete delete(string $dbName) Returns a new `DELETE` statement object for the named database
 * @method \Sphp\Database\Update update(string $dbName) Returns a new `UPDATE` statement object for the named database
 * @method \Sphp\Database\Insert insert(string $dbName) Returns a new `INSERT` statement object for the named database
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Db {

  /**
   * @var Db[]
   */
  private static $instances = [];

  /**
   * @var string[] 
   */
  private $map = [
      'mysql' => 'MySQL',
      'sqlsrv' => 'Microsoft'
  ];

  /**
   * @var PDO 
   */
  private $pdo;

  /**
   * Constructor
   *
   * @param  PDO $pdo connection object between PHP and a database server
   * @link   http://www.php.net/manual/en/book.pdo.php PHP Data Objects
   */
  public function __construct(PDO $pdo = null) {
    $this->pdo = $pdo;
    //$this->strategy = new StatementStrategy($pdo);
  }

  /**
   * Returns the connection object between PHP and a database server 
   * 
   * @return PDO connection object between PHP and a database server 
   */
  public function getPdo(): PDO {
    return $this->pdo;
  }

  /**
   * 
   * @param PDO $db the connection object between PHP and a database server
   * @param string $name optional name of the instance created
   */
  public static function createFrom(PDO $db, string $name = null): Db {
    $instance = new static($db);
    if ($name === null) {
      self::$instances[0] = $instance;
    } else {
      self::$instances[$name] = $instance;
    }
    return $instance;
  }

  /**
   * 
   * @param  string|null $name
   * @return Db
   * @throws InvalidArgumentException
   * @deprecated
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
   * @param  array $arguments
   * @return Statement
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
   * @param  string $className the type name of the instance created
   * @param  array $arguments
   * @return Statement
   * @throws BadMethodCallException
   */
  public function __call(string $className, array $arguments = []) {
    $result = __NAMESPACE__ . "\\Legacy\\" . ucfirst($className);
    if (!class_exists($result)) {
      throw new InvalidArgumentException("Statement ($className) cannot be created");
    }
    $driverName = $this->pdo->getAttribute(PDO::ATTR_DRIVER_NAME);
    if (array_key_exists($driverName, $this->map)) {
      $try = __NAMESPACE__ . "\\{$this->map[$driverName]}\\$className";
      //var_dump($try);
      if (class_exists($try)) {
        $result = $try;
      }
    }
    return new $result($this->pdo);
  }

}
