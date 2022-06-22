<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\ContactForm;

use Sphp\Stdlib\Datastructures\Arrayable;
use ArrayAccess;
use IteratorAggregate;
use Countable;
use Sphp\Exceptions\NullPointerException;

/**
 * Application Configuration class for storing common application data
 *
 * **Note:** Uses Singleton pattern
 *
 * Stored variable names can either be an `integer` or a `string`.
 * Additionally the following <var>$varName</var> casting is equal with the
 * PHP array key casting. The <var>$value</var> can be of any type.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class DataObject implements ArrayAccess, Arrayable, IteratorAggregate, Countable, \Serializable {

  private array $data;

  public function __construct() {
    $this->data = [];
  }

  public function __destruct() {
    unset($this->data);
  }

  public function serialize() {
    return serialize($this->data);
  }

  public function unserialize($data) {
    $this->data = unserialize($data);
  }

  /**
   * Handles unset properties
   * 
   * @param  string $property the name of the property
   * @throws NullPointerException if the property is undefined
   */
  public function __get(string $property) {
    return $this->offsetGet($property);
  }

  /**
   * 
   * 
   * @param  string $property
   * @param  mixed $value
   * @return void
   */
  public function __set(string $property, $value): void {
    $this->offsetSet($property, $value);
  }

  /**
   * 
   * 
   * @param  string $property
   * @return void
   */
  public function __unset(string $property): void {
    $this->offsetUnset($property);
  }

  /**
   * 
   * 
   * @param  string $property
   * @return void
   */
  public function __isset(string $property): bool {
    return $this->offsetExists($property);
  }

  /**
   * Checks whether the specific configuration variable exists
   * 
   * @param  mixed $property the name of the variable
   * @return bool true on success or false on failure
   */
  public function offsetExists(mixed $property): bool {
    return array_key_exists($property, $this->data);
  }

  /**
   * Assigns a value to the specified  configuration variable
   * 
   * @param  mixed $property the name of the variable
   * @return mixed the value at the 
   */
  public function offsetGet(mixed $property): mixed {
    $result = null;
    if ($this->offsetExists($property)) {
      $result = $this->data[$property];
    }
    return $result;
  }

  /**
   * Assigns a value to the specified configuration variable
   * 
   * @param  mixed $property the name of the variable
   * @param  mixed $value the value to set
   * @return void
   */
  public function offsetSet(mixed $property, mixed $value): void {
    $this->data[$property] = $value;
  }

  /**
   * Unsets the specified variable
   * 
   * @param  mixed $property the name of the variable
   * @return void
   */
  public function offsetUnset(mixed $property): void {
    if ($this->offsetExists($property)) {
      unset($this->data[$property]);
    }
  }

  public function contains(string $name): bool {
    return $this->offsetExists($name);
  }

  public function toArray(): array {
    $arr = [];
    foreach ($this->data as $key => $value) {
      if (!$value instanceof DataObject) {
        $arr[$key] = $value;
      } else {
        $arr[$key] = $value->toArray();
      }
    }
    return $arr;
  }

  public function getIterator(): \Traversable {
    return new \ArrayIterator($this->toArray());
  }

  /**
   * Returns the number of set properties
   * 
   * @return int the number of set properties
   */
  public function count(): int {
    return count($this->data);
  }

  public static function fromArray(array $data): DataObject {
    $result = new static();
    foreach ($data as $key => $value) {
      if (!is_array($value)) {
        $result[$key] = $value;
      } else {
        $result[$key] = static::fromArray($value);
      }
    }
    return $result;
  }

}
