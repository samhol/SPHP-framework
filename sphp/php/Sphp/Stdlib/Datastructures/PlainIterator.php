<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Datastructures;

use Iterator;
use Traversable;
use Countable;

/**
 * Implements a basic iterator for any type of data
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class PlainIterator implements Iterator, Arrayable, Countable {

  /**
   * @var array
   */
  private $collection;

  /**
   * Constructor
   * 
   * @param array|Traversable $collection
   */
  public function __construct($collection) {
    if ($collection instanceof Traversable) {
      $collection = iterator_to_array($collection);
    }
    if (!is_array($collection)) {
      $collection = [$collection];
    }
    $this->collection = $collection;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->collection);
  }

  public function toArray(): array {
    return $this->collection;
  }

  /**
   * Count the number of items in the iterator
   *
   * @return int the number of items in the iterator
   * @link   http://php.net/manual/en/class.countable.php Countable
   */
  public function count(): int {
    return count($this->collection);
  }

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current() {
    return current($this->collection);
  }

  /**
   * Advance the internal pointer of the collection
   * 
   * @return void
   */
  public function next() {
    next($this->collection);
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key() {
    return key($this->collection);
  }

  /**
   * Rewinds the Iterator to the first element
   * 
   * @return void
   */
  public function rewind() {
    reset($this->collection);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid(): bool {
    return false !== current($this->collection);
  }

}
