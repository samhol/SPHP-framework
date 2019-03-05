<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Datastructures;

use IteratorAggregate;
use Traversable;
use Sphp\Stdlib\Datastructures\Arrayable;
use ArrayIterator;

/**
 * Implements an Object Storage
 * 
 * **Usage:**
 * <pre>
 * $coll = new ObjectStorage();
 * $coll->attach(new stdClass)
 * //... 
 * $coll->remove(new stdClass);
 * </pre>
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ObjectStorage implements IteratorAggregate, Arrayable {

  /**
   * @var object[]
   */
  private $objects;

  /**
   * Constructor
   */
  public function __construct() {
    $this->objects = [];
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->objects);
  }

  /**
   * 
   * 
   * @param  object $object
   * @return string
   */
  public function getHash(object $object): string {
    return spl_object_hash($object);
  }

  /**
   * Adds an object inside the storage
   * 
   * @param  object $object
   * @return string
   */
  public function attach(object $object): string {
    $hash = $this->getHash($object);
    $this->objects[$hash] = $object;
    return $hash;
  }

  /**
   * 
   * @param  object $object
   * @return bool if the object exists
   */
  public function containsObject(object $object): bool {
    return $this->containsHash($this->getHash($object));
  }

  public function containsHash(string $hash): bool {
    return array_key_exists($hash, $this->objects);
  }

  public function getObject(string $hash): ?object {
    $obj = null;
    if ($this->containsHash($hash)) {
      $obj = $this->objects[$hash];
    }
    return $obj;
  }

  /**
   * Removes object by object hash
   * 
   * @param string $hash object hash
   * @return bool true if removed, false otherwise 
   */
  public function removeById(string $hash): bool {
    if ($this->containsHash($hash)) {
      unset($this->objects[$hash]);
      return true;
    }
    return false;
  }

  /**
   * Removes object from storage
   * 
   * @param  object $object to remove
   * @return bool true if removed, false otherwise 
   */
  public function remove(object $object): bool {
    $hash = $this->getHash($object);
    return $this->removeById($hash);
  }

  public function getIterator(): Traversable {
    return new ArrayIterator($this->objects);
  }

  public function toArray(): array {
    return $this->objects;
  }

  /**
   * Creates and returns new queue
   *
   * @return Queue new instance from the collection
   */
  public function toQueue(): Queue {
    $queue = new ArrayQueue();
    foreach ($this->objects as $item) {
      $queue->enqueue($item);
    }
    return $queue;
  }

  /**
   * Creates and returns new stack
   *
   * @return Stack new instance from the collection
   */
  public function toStack(): Stack {
    $stack = new ArrayStack();
    foreach ($this->objects as $item) {
      $stack->push($item);
    }
    return $stack;
  }

}
