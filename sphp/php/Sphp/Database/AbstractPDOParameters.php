<?php

/**
 * TaskRunner.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

use PDO;
use PDOStatement;
use PDOException;
use Sphp\Exceptions\RuntimeException;
use Iterator;
use Sphp\Stdlib\Datastructures\Arrayable;

/**
 * Base class for all SQL Statement classes
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class AbstractPDOParameters implements \ArrayAccess, Iterator, \Countable, Arrayable {

  /**
   * @var array
   */
  private $params = [];

  /**
   * Constructs a new instance
   *
   * @param int $type

    public function __construct() {

    } */

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->params);
  }

  /**
   * 
   * @param  mixed $value
   * @param  int $type
   * @return self for a fluent interface
   */
  public function appendParams($value, int $type = PDO::PARAM_STR) {
    $this->paramTypes[] = $type;
    $this->params[] = $value;
    return $this;
  }

  /**
   * 
   * @param  mixed $name
   * @param  mixed $value
   * @param  int $type
   * @return self for a fluent interface
   */
  public function setParam($name, $value, int $type = PDO::PARAM_STR) {
    if ($name === null) {
      $this->paramTypes[] = $type;
      $this->params[] = $value;
    } else {
      $this->paramTypes[$name] = $type;
      $this->params[$name] = $value;
    }
    return $this;
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

  public function hasParams(): bool {
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

  public function toArray(): array {
    return $this->params;
  }

}
