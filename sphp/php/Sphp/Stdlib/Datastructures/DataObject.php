<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Datastructures;

use Sphp\Stdlib\Datastructures\Arrayable;
use ArrayAccess;
use IteratorAggregate;
use Countable;
use stdClass;
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
class DataObject extends stdClass implements ArrayAccess, Arrayable, IteratorAggregate, Countable {

  /**
   * Handles unset properties
   * 
   * @param  string $property the name of the property
   * @throws NullPointerException if the property is undefined
   */
  public function __get(string $property) {
    throw new NullPointerException(sprintf("Undefined property: %s::%s", __CLASS__, $property));
  }

  /**
   * Checks whether the specific configuration variable exists
   * 
   * @param  string $property the name of the variable
   * @return boolean true on success or false on failure
   */
  public function offsetExists($property): bool {
    return isset($this->$property);
  }

  /**
   * Assigns a value to the specified  configuration variable
   * 
   * @param  string $property the name of the variable
   * @return mixed the value at the 
   * @throws NullPointerException if the property is undefined
   */
  public function offsetGet($property) {
    return $this->{$property};
  }

  /**
   * Assigns a value to the specified configuration variable
   * 
   * @param  string $varname the name of the variable
   * @param  mixed $value the value to set
   */
  public function offsetSet($varname, $value): void {
    $this->{$varname} = $value;
  }

  /**
   * Unsets the specified variable
   * 
   * @param  string $property the name of the variable
   */
  public function offsetUnset($property): void {
    if (isset($this->$property)) {
      unset($this->$property);
    }
  }

  public function toArray(): array {
    $f = function ($data) use (&$f) {
      if ($data instanceof DataObject) {
        $data = get_object_vars($data);
      }
      if (is_array($data)) {
        return array_map($f, $data);
      } else {
        return $data;
      }
    };
    return $f($this);
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
    return count(get_object_vars($this));
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
