<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Data;

use Sphp\Stdlib\Datastructures\Arrayable;
use ArrayAccess;
use IteratorAggregate;
use Traversable;
use Sphp\Exceptions\OutOfRangeException;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Exceptions\BadMethodCallException;

/**
 * Abstract implementation of a Data object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractDataObject implements ArrayAccess, Arrayable, IteratorAggregate {

  private $data;

  /**
   * Constructor
   * 
   * @param array|null $data optional data
   */
  public function __construct(array $data = []) {
    $this->fromArray($data);
  }

  /**
   * Destructor
   */
  public function __destruct() {
//unset($this->data);
  }

  /**
   * 
   * @param  string $name
   * @param  array $arguments
   * @return void|mixed
   * @throws BadMethodCallException
   */
  public function __call(string $name, array $arguments) {
    if (!$this->offsetExists($name)) {
      throw new BadMethodCallException("Cannot call method: method $name does not exist");
    }
    $numArgs = count($arguments);
    if ($numArgs === 1) {
      $this->offsetSet($name, $arguments[0]);
    } else if ($numArgs === 0) {
      return $this->offsetGet($name);
    } else {
      throw new BadMethodCallException("Cannot call method $name: method invalid number of argumwents does not exist");
    }
  }

  public function __isset($name): bool {
    return $this->offsetExists($name);
  }

  public function __set($name, $value): void {
    $this->offsetSet($name, $value);
  }

  public function __get($name) {
    return $this->offsetGet($name);
  }

  public function __unset($name): void {
    $this->offsetUnset($name);
  }

  public function __toString(): string {
    return $this->toJson();
  }

  /**
   * 
   * @param  array $data
   * @return $this for a fluent interface
   */
  public abstract function fromArray(array $data);

  public function contains(string $name): bool {
    return $this->offsetExists($name) && !empty($this->{$name});
  }

  public function toJson(): string {
    return json_encode($this->toArray(), JSON_PRETTY_PRINT);
  }

  public function getIterator(): Traversable {
    return new \ArrayIterator($this->toArray());
  }

  public function offsetExists($offset): bool {
    return array_key_exists($offset, $this->data);
  }

  public function offsetGet($offset) {
    if ($this->offsetExists($offset)) {
      return $this->data[$offset];
    } else {
      throw new OutOfRangeException("Offset '$offset' does not exist");
    }
  }

  /**
   * 
   * @param  mixed $offset
   * @param  mixed $value
   * @throws InvalidArgumentException
   * @throws OutOfRangeException
   */
  public function offsetSet($offset, $value): void {
    if ($this->offsetExists($offset)) {
      $this->data[$offset] = $value;
    } else {
      throw new OutOfRangeException("Setting member variable failed: '$offset' does not exist");
    }
  }

  /**
   * 
   * @param  mixed $offset
   * @return void
   */
  public function offsetUnset($offset): void {
    if ($this->offsetExists($offset)) {
      unset($this->data[$offset]);
    }
  }

  /**
   * 
   * @param  array $data
   * @return void
   */
  protected function setInitialData(array $data): void {
    $this->data = $data;
  }

}
