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
class PDOParameters implements ParameterHandler {

  /**
   * @var array
   */
  private $params = [];

  /**
   * @var array
   */
  private $types = [];
  
  /**
   * @var boolean 
   */
  private $indexed = true;

  /**
   * Constructs a new instance
   *
   * @param bool $indexed
   */
  public function __construct(bool $indexed = true) {
    $this->indexed = $indexed;
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->params);
  }

  public function isValidParamName($name): bool {
    if ($this->isIndexed()) {
      return $name === null || (is_int($name) && $name > 0);
    } else {
      return (preg_match("/^[:]?[a-zA-Z]{1,}[a-zA-Z0-9_]+$/", $name) !== 1);
    }
  }

  public function isIndexed(): bool {
    return $this->indexed;
  }

  /**
   * 
   * @param  mixed $name
   * @param  mixed $value
   * @param  int $type
   * @return self for a fluent interface
   */
  public function setParam($name, $value, int $type = PDO::PARAM_STR) {
    if (!$this->isValidParamName($name)) {
      throw new \Sphp\Exceptions\InvalidArgumentException('Invalid parameter name');
    }
    if ($this->indexed) {
      $this->setIndexed($name, $value, $type);
    } else {
      $this->setNamed($name, $value, $type);
    }
    return $this;
  }

  protected function setIndexed($name, $value, int $type = PDO::PARAM_STR) {
    if ($this->isEmpty() && $name === null) {
      $this->params[1] = $value;
      $this->types[1] = $type;
    } else {
      $this->params[$name] = $value;
      $this->types[$name] = $type;
    }
    return $this;
  }

  protected function setNamed(string $name, $value, int $type = PDO::PARAM_STR) {
    if (substr($name, 0, 1) !== ':') {
      $name = ":$name";
    }
    $this->params[$name] = $value;
    $this->types[$name] = $type;
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

  public function isEmpty(): bool {
    return empty($this->params);
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
  public function getParamNames(): array {
    return array_keys($this->params);
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

  /**
   * 
   * @return PDOStatement
   * @throws \Sphp\Exceptions\RuntimeException
   */
  public function bindTo(PDOStatement $statement): PDOStatement {
    try {
      foreach ($this as $name => $value) {
        $statement->bindValue($name, $value, $this->getParamType($name));
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
    if (is_string($offset) && substr($offset, 0, 1) !== ':') {
      $offset = ":$offset";
    }
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

  public function getValue($offset) {
    if (!$this->offsetExists($offset)) {
      return null;
    }
    return $this->params[$offset];
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
