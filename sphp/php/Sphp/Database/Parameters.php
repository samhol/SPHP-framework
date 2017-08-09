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
use Sphp\Exceptions\InvalidArgumentException;
use Iterator;
use Sphp\Stdlib\Datastructures\Arrayable;

/**
 * Base class for all SQL Statement classes
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class Parameters implements ParameterHandler {

  /**
   * @var array
   */
  private $params = [];

  /**
   * @var array
   */
  private $types = [];

  /**
   * Constructs a new instance
   *
   * @param int $indexing
   */
  public function __construct() {
    $this->params = [];
    $this->types = [];
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->params, $this->types);
  }

  /**
   * Merges given parameters
   * 
   * @param  array|Traversable $params parameters to merge
   * @return self for a fluent interface
   * @throws \Exception if merging fails
   */
  abstract public function mergeParams($params);

  /**
   * 
   * @param  mixed $name
   * @param  mixed $value
   * @param  int $type
   * @return self for a fluent interface
   */
  public function setParam($name, $value, int $type = PDO::PARAM_STR) {
    $this->params[$name] = $value;
    $this->types[$name] = $type;
    return $this;
  }

  public function unsetParam($name) {
    if ($this->contains($name)) {
      unset($this->paramTypes[$name], $this->params[$name]);
    }
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

  public function contains($offset): bool {
    return array_key_exists($offset, $this->params);
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
    if (!$this->contains($index)) {
      throw new InvalidArgumentException("param '$index' not found");
    }
    return $this->types[$index];
  }

  public function getParamValue($name) {
    if (!$this->offsetExists($name)) {
      return null;
    }
    return $this->params[$name];
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
    // print_r($this->toArray());
    try {
      $this->bindTo($statement)->execute();
      return $statement;
    } catch (PDOException $e) {
      throw new RuntimeException($e->getMessage());
    }
  }

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current() {
    return current($this->params);
  }

  /**
   * Advance the internal pointer of the collection
   */
  public function next() {
    next($this->params);
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key() {
    return key($this->params);
  }

  /**
   * Rewinds the Iterator to the first element
   */
  public function rewind() {
    reset($this->params);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid(): bool {
    return false !== current($this->params);
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
    $this->unsetParam($offset);
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

  /**
   * 
   * @param  \Traversable|array|null $params
   * @return Parameters
   */
  public static function fromArray($params = null): Parameters {
    if (\Sphp\Stdlib\Arrays::isIndexed($params)) {
      $par = new SequentialParameters($params);
    } else {
      $par = new NamedParameters($params);
    }
    return $par;
  }

}
