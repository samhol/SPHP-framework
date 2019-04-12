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
class DataObject extends stdClass implements ArrayAccess, Arrayable, IteratorAggregate {

  public function __get(string $name) {
    if (isset($this->$name)) {
      return $this->$name;
    } else {
      return null;
    }
  }

  public function __isset(string $name): bool {
    return isset($this->$name) && $this->$name !== null;
  }

  /**
   * Checks whether the specific configuration variable exists
   * 
   * @param  string $varname the name of the variable
   * @return boolean true on success or false on failure
   */
  public function offsetExists($varname): bool {
    return isset($this->$varname);
  }

  /**
   * Assigns a value to the specified  configuration variable
   * 
   * @param  string $varname the name of the variable
   * @return mixed the value at the 
   */
  public function offsetGet($varname) {
    if (!$this->offsetExists($varname)) {
      $this->{$varname} = new self();
    }
    return $this->{$varname};
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
   * @param  string $varname the name of the variable
   */
  public function offsetUnset($varname): void {
    if ($this->offsetExists($varname)) {
      unset($this->{$varname});
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
