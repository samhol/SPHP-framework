<?php

/**
 * TaskRunner.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

use PDO;
use PDOStatement;
use PDOException;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Exceptions\RuntimeException;
use Iterator;

/**
 * Base class for all SQL Statement classes
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SequentialPDOParameters extends AbstractPDOParameters {

  /**
   * 
   * @param  string $name
   * @param  mixed $value
   * @param  int $type
   * @return self for a fluent interface
   */
  public function setParam($name, $value, int $type = PDO::PARAM_STR) {
    if (!is_int($name) || $name <= 0) {
      throw new InvalidArgumentException('Offset must be a positive integer');
    }
    parent::setParam($name, $value, $type);
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
   * 
   * @param  array|Traversable $params
   * @return self for a fluent interface
   * @throws InvalidArgumentException
   */
  public function mergeParams($params) {
    if (!is_iterable($params) || is_array($params)) {
      throw new InvalidArgumentException('Merged data must be an iterable object or an array');
    }
    foreach ($params as $name => $value) {
      if (is_int($name)) {
        $this->setParam($name, $value);
      } else {
        $this->setParam(null, $value);
      }
    }
    return $this;
  }

  /**
   * Returns an array of values with as many elements as there are bound
   * parameters in the clause
   *
   * @return array values that are vulnerable to an SQL injection
   */
  public function getParamType($index): array {
    return $this->paramTypes[$index];
  }

  /**
   * 
   * @return PDOStatement
   * @throws \Sphp\Exceptions\RuntimeException
   */
  public function bindTo(PDOStatement $statement): PDOStatement {
    try {
      foreach ($this as $name => $value) {
        $statement->bindValue($name, $value);
      }
      return $statement;
    } catch (PDOException $e) {
      throw new RuntimeException($e->getMessage(), 0, $e);
    }
  }

  /**
   * 
   * 
   * @param  PDOStatement $statement
   * @return PDOStatement
   * @throws \Sphp\Exceptions\RuntimeException
   */
  public function executeIn(PDOStatement $statement): PDOStatement {
    try {
      $statement->execute($this->toArray());
      return $statement;
    } catch (PDOException $e) {
      throw new RuntimeException($e->getMessage(), 0, $e);
    }
  }

  public function offsetSet($offset, $value) {
    $this->setParam($offset, $value);
    return $this;
  }

  public function offsetUnset($offset) {
    if (is_string($offset) && !\Sphp\Stdlib\Strings::startsWith($offset, ':')) {
      $name = ":$name";
    }
    if ($this->offsetExists($offset)) {
      unset($this->paramTypes[$offset], $this->params[$offset]);
    }
    return $this;
  }

}
