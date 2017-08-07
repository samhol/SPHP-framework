<?php

/**
 * SimpleParameterContainer.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

use PDO;
use PDOStatement;
use PDOException;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Exceptions\RuntimeException;

/**
 * Base class for all SQL Statement classes
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SimpleParameterContainer implements \Iterator, \Countable, \Sphp\Stdlib\Datastructures\Arrayable {

  /**
   * @var array
   */
  private $params = [];

  /**
   * @var int
   */
  private $paramType;

  /**
   * Constructs a new instance
   * 
   * @param mixed $params
   */
  public function __construct($params = null, int $type = PDO::PARAM_STR) {
    if ($params !== null) {
      $this->mergeParams($params);
    }
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->params, $this->paramType);
  }

  /**
   * 
   * @param  mixed $value
   * @param  int $type
   * @return self for a fluent interface
   */
  public function appendParam($value, int $type = PDO::PARAM_STR) {
    $this->setParam(null, $value, $type);
    return $this;
  }

  /**
   * 
   * @param  array $value
   * @param  int $type
   * @return self for a fluent interface
   */
  public function appendParams(array $params, int $type = PDO::PARAM_STR) {
    foreach ($params as $value) {
      $this->setParam(null, $value, $type);
    }
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
    if ($name !== null && (!is_int($name) || $name < 0)) {
      throw new InvalidArgumentException('Offset must be zero or a positive integer');
    }
    if ($name === null) {
      $this->paramTypes[] = $type;
      $this->params[] = $value;
    } else {
      $this->paramTypes[$name] = $type;
      $this->params[$name] = $value;
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
    if (!is_array($params) && !$params instanceof \Traversable) {
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
  public function getParamType($index): int {
    return $this->paramTypes[$index];
  }

  public function unsetParam($name) {
    unset($this->paramTypes[$name], $this->params[$name]);
    return $this;
  }

  public function unsetParams() {
    $this->paramTypes = [];
    $this->params = [];
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

  public function getValue($offset) {
    if (!$this->offsetExists($offset)) {
      return null;
    }
    return $this->params[$offset];
  }

  public function notEmpty(): bool {
    return !empty($this->params);
  }

  public function count(): int {
    return count($this->params);
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
   * Returns an array of values with as many elements as there are bound
   * parameters in the clause
   *
   * @return array values that are vulnerable to an SQL injection
   */
  public function getParamNames(): array {
    return array_keys($this->params);
  }

  /**
   * 
   * @return PDOStatement
   * @throws \Sphp\Exceptions\RuntimeException
   */
  public function bindTo(PDOStatement $statement): PDOStatement {
    try {
      $k = 1;
      foreach ($this as $name => $value) {
        $statement->bindValue($k++, $value);
      }
      return $statement;
    } catch (PDOException $e) {
      throw new RuntimeException('Binding failed', 0, $e);
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
      print_r($this->toArray());
      $statement->execute($this->toArray());
      return $statement;
    } catch (PDOException $e) {
      throw new RuntimeException($e->getMessage(), 0, $e);
    }
  }

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current() {
    return current($this->items);
  }

  /**
   * Advance the internal pointer of the collection
   */
  public function next() {
    next($this->items);
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key() {
    return key($this->items);
  }

  /**
   * Rewinds the Iterator to the first element
   */
  public function rewind() {
    reset($this->items);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid(): bool {
    return false !== current($this->items);
  }

  public function offsetExists($offset): bool {
    return array_key_exists($offset, $this->params);
  }

  public function offsetGet($offset) {
    if (!$this->offsetExists($offset)) {
      return null;
    }
    return $this->params[$offset];
  }

  public function offsetSet($offset, $value) {
    $this->setParam($offset, $value);
    return $this;
  }

  public function offsetUnset($offset) {
    if ($this->offsetExists($offset)) {
      unset($this->paramTypes[$offset], $this->params[$offset]);
    }
    return $this;
  }

  /**
   * Returns an array of values with as many elements as there are bound
   * parameters in the clause
   *
   * @return array values that are vulnerable to an SQL injection
   */
  public function toArray(): array {
    return $this->params;
  }

}
