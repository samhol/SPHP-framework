<?php

/**
 * AbstractStatement.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

use PDO;
use PDOStatement;
use PDOException;
use Sphp\Exceptions\RuntimeException;

/**
 * Base class for all SQL Statement classes
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractStatement implements StatementInterface {

  /**
   * @var TaskRunner 
   */
  private $pdoRunner;

  /**
   * Constructs a new instance
   *
   * @param  TaskRunner $pdo the database connection
   * @link   http://www.php.net/manual/en/book.pdo.php PHP Data Objects
   */
  public function __construct(PDORunner $pdo) {
    $this->setPDORunner($pdo);
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->pdoRunner);
  }

  public function getPDORunner(): PDORunner {
    return $this->pdoRunner;
  }

  /**
   * 
   * @param PDO $pdo
   * @return self for a fluent interface
   */
  public function setPDORunner(PDORunner $pdo) {
    $this->pdoRunner = $pdo;
    $this->pdoRunner->getPdo()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->pdoRunner->getPdo()->setAttribute(PDO::ATTR_PERSISTENT, true);
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
    $this->pdoRunner->setParam($name, $value, $type);
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
    $this->pdoRunner->setParams($params, $type);
    return $this;
  }

  /**
   * Returns an array of values with as many elements as there are bound
   * parameters in the clause
   *
   * @return array values that are vulnerable to an SQL injection
   */
  public function getParams(): array {
    return $this->pdoRunner->getParams();
  }

  /**
   * 
   * @return PDOStatement
   * @throws \Sphp\Exceptions\RuntimeException
   */
  public function getStatement(): PDOStatement {
    echo $this->statementToString();
    try {
      return $this->getPDORunner()->setSql($this->statementToString())->getStatement();
    } catch (\PDOException $e) {
      echo $this->statementToString();
      throw new \Sphp\Exceptions\RuntimeException($e);
    }
  }

  /**
   * 
   * @return PDOStatement
   * @throws \Sphp\Exceptions\RuntimeException
   */
  public function execute(): PDOStatement {
    try {
      $this->pdoRunner->setSql($this->statementToString());
      return $this->pdoRunner->execute();
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
