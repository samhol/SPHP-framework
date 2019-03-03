<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database\Parameters;

use Iterator;
use PDO;
use PDOStatement;
use PDOException;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Database\Exceptions\DatabaseException;

/**
 * Abstract implementation of parameter handler
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractParameterHandler implements Iterator, ParameterHandler {

  /**
   * @var array
   */
  private $params = [];

  /**
   * @var array
   */
  private $types = [];

  /**
   * Constructor
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
   * @return $this for a fluent interface
   * @throws \Exception if merging fails
   */
  abstract public function mergeParams($params);

  public function setParam($name, $value, int $type = PDO::PARAM_STR) {
    $this->params[$name] = $value;
    $this->types[$name] = $type;
    return $this;
  }

  public function setParams(array $params, int $type = PDO::PARAM_STR) {
    foreach ($params as $name => $value) {
      $this->setParam($name, $value, $type);
    }
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

  public function bindTo(PDOStatement $statement): PDOStatement {
    try {
      foreach ($this as $name => $value) {
        $statement->bindValue($name, $value, $this->getParamType($name));
      }
      return $statement;
    } catch (PDOException $e) {
      throw new DatabaseException($e->getMessage(), $e->getCode(), $e);
    }
  }

  public function executeIn(PDOStatement $statement): PDOStatement {
    // print_r($this->toArray());
    try {
      $this->bindTo($statement)->execute();
      return $statement;
    } catch (PDOException $e) {
      throw new DatabaseException($e->getMessage(), $e->getCode(), $e);
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
   * 
   * @return void
   */
  public function next(): void {
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
   * 
   * @return void
   */
  public function rewind(): void {
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

  /**
   * 
   * @param  type $offset
   * @param  type $value
   * @return void
   */
  public function offsetSet($offset, $value) {
    $this->setParam($offset, $value);
  }

  /**
   * 
   * @param  type $offset
   * @return void
   */
  public function offsetUnset($offset) {
    $this->unsetParam($offset);
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
   * @return AbstractParameterHandler
   */
  public static function fromArray($params = null): AbstractParameterHandler {
    if (\Sphp\Stdlib\Arrays::isIndexed($params)) {
      $par = new SequentialParameterHandler($params);
    } else {
      $par = new NamedParameters($params);
    }
    return $par;
  }

}
