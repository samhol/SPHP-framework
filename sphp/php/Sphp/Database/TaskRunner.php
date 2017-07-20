<?php

/**
 * TaskRunner.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

use PDO;

/**
 * Base class for all SQL Statement classes
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 * @deprecated
 */
class TaskRunner {

  /**
   * @var PDO 
   */
  private $pdo;

  /**
   * @var string 
   */
  private $sql = '';

  /**
   * @var array
   */
  private $params = [];

  /**
   * Constructs a new instance
   *
   * @param  PDO $pdo the database connection
   * @link   http://www.php.net/manual/en/book.pdo.php PHP Data Objects
   */
  public function __construct(PDO $pdo) {
    $this->setPdo($pdo);
  }

  public function getSql(): string {
    return $this->sql;
  }

  public function setSql(string $sql) {
    $this->sql = $sql;
    return $this;
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->pdo);
  }

  public function getPdo(): PDO {
    return $this->pdo;
  }

  /**
   * 
   * @param PDO $pdo
   * @return self for a fluent interface
   */
  public function setPdo(PDO $pdo) {
    $this->pdo = $pdo;
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->pdo->setAttribute(PDO::ATTR_PERSISTENT, true);
    return $this;
  }

  /**
   * 
   * @param  string $name
   * @param  mixed $value
   * @param  int $type
   * @return self for a fluent interface
   */
  public function setParam($name, $value, int $type = PDO::PARAM_STR) {
    $this->paramMap[$name] = ['value' => $value, 'type' => $type];
    return $this;
  }

  /**
   * Returns an array of values with as many elements as there are bound
   * parameters in the clause
   *
   * @param  array $params
   * @param  int $type
   * @return self for a fluent interface
   */
  public function setParams(array $params, int $type = PDO::PARAM_STR) {
    foreach ($params as $name => $value) {
      $this->setParam($name, $value, $type);
    }
    return $this;
  }

  /**
   * Returns an array of values with as many elements as there are bound
   * parameters in the clause
   *
   * @return array values that are vulnerable to an SQL injection
   */
  public function getParams(): array {
    return $this->params;
  }

  /**
   * 
   * @return \PDOStatement
   * @throws \Sphp\Exceptions\RuntimeException
   */
  public function getStatement(): \PDOStatement {
    try {
      return $this->getPdo()->prepare($this->getSql());
    } catch (\PDOException $e) {
      throw new \Sphp\Exceptions\RuntimeException($e);
    }
  }

  /**
   * 
   * @return \PDOStatement
   * @throws \Sphp\Exceptions\RuntimeException
   */
  public function execute(): \PDOStatement {
    try {
      $sth = $this->getStatement();
      $sth->execute($this->getParams());
      return $sth;
    } catch (\PDOException $e) {
      throw new \Sphp\Exceptions\RuntimeException($e);
    }
  }

}
