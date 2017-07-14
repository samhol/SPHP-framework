<?php

/**
 * AbstractStatement.php (UTF-8)
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
abstract class AbstractStatement implements DBConnectorInterface, StatementInterface {

  /**
   * @var PDO 
   */
  private $pdo;

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
  public function setParam(string $name, $value, int $type = PDO::PARAM_STR) {
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
   * @return mixed|mixed[] values that are vulnerable to an SQL injection
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
      echo $this->statementToString();
    try {
      return $this->getPdo()->prepare($this->statementToString());
    } catch (\PDOException $e) {
      echo $this->statementToString();
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

  public function __toString(): string {
    $keys = array();
    $values = $this->getParams();

    # build a regular expression for each parameter
    foreach ($this->getParams() as $key => $value) {
      if (is_string($key)) {
        $keys[] = '/:' . $key . '/';
      } else {
        $keys[] = '/[?]/';
      }

      if (is_array($value)) {
        $values[$key] = implode(',', $value);
      }

      if (is_null($value)) {
        $values[$key] = 'null';
      }
    }
    // Walk the array to see if we can add single-quotes to strings
    array_walk($values, create_function('&$v, $k', 'if (!is_numeric($v) && $v!="null") $v = "\'".$v."\'";'));

    $query = preg_replace($keys, $values, $this->statementToString(), 1, $count);

    return $query;
  }

}
