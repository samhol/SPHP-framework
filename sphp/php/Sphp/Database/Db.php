<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database;

use PDO;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Database\Exceptions\BadMethodCallException;

/**
 * Implements a Database statement factory
 *    
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Db {

  /**
   * @var string[] 
   */
  private array $map = [
      'mysql' => 'MySQL',
      'sqlsrv' => 'Microsoft'
  ];
  private PDO $pdo;

  /**
   * Constructor
   *
   * @param  PDO $pdo connection object between PHP and a database server
   * @link   https://www.php.net/manual/en/book.pdo.php PHP Data Objects
   */
  public function __construct(PDO $pdo) {
    $this->pdo = $pdo;
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
   * @param  string $className the type name of the instance created
   * @param  array $arguments
   * @return Statement
   * @throws BadMethodCallException
   */
  public function __call(string $className, array $arguments) {

    $class = $this->getCorrectType($className);
    return new $class($this->pdo);
  }

  private function getCorrectType(string $type): string {
    $driverName = $this->pdo->getAttribute(PDO::ATTR_DRIVER_NAME);
    if (array_key_exists($driverName, $this->map)) {
      $nonLegacyTry = __NAMESPACE__ . "\\{$this->map[$driverName]}\\$type";
    }
    $legacyTry = __NAMESPACE__ . "\\Legacy\\$type";
    if (class_exists($nonLegacyTry)) {
      $class = $nonLegacyTry;
    } else if (class_exists($legacyTry)) {
      $class = $legacyTry;
    } else {
      throw new BadMethodCallException("Statement ($type) cannot be created");
    }
    return $class;
  }

  /**
   * Returns a new SELECT SQL statement instance
   * 
   * @param  string $rowset the source of a rowset
   * @return Query new instance
   */
  public function query(string ... $rowset): Query {
    $class = $this->getCorrectType('Query');
    $query = new $class($this->pdo);
    $query->from(...$rowset);
    return $query;
  }

  /**
   * Returns a new INSERT SQL statement instance
   * 
   * @param  string $table
   * @param  iterable|null $data
   * @return Insert new instance
   */
  public function insert(string $table, ?iterable $data = null): Insert {
    $class = $this->getCorrectType('Insert');
    $insert = new $class($this->pdo);
    $insert->into($table);
    if ($data !== null) {
      $insert->valuesFromArray($data);
    }
    return $insert;
  }

  /**
   * Returns a new DELETE SQL statement instance
   * 
   * @param  string $table 
   * @return Delete new instance
   */
  public function delete(string $table): Delete {
    $class = $this->getCorrectType('Delete');
    $delete = new $class($this->pdo);
    $delete->from($table);
    return $delete;
  }

  /**
   * Returns a new UPDATE SQL statement instance
   * 
   * @param  string $table
   * @param  iterable|null $data
   * @return Update new instance
   */
  public function update(string $table, ?iterable $data = null): Update {
    $class = $this->getCorrectType('Update');
    $update = new $class($this->pdo);
    $update->table($table);
    if ($data !== null) {
      $update->setColumns($data);
    }
    return $update;
  }

}
