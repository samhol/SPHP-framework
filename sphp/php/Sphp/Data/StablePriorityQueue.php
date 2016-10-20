<?php

/**
 * StablePriorityQueue.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Data;

use SplPriorityQueue;
use Serializable;
use Sphp\Core\Types\Arrays;

/**
 * An implementation of a stable priority queue
 *
 * A priority queue is stable if deletions of items with equal
 *  priority value occur in the order in which they were inserted
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-02-07
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class StablePriorityQueue extends SplPriorityQueue implements Arrayable, Serializable {

  /**
   * seed value to maintain insertion order
   *
   * @var int
   */
  private $serial = PHP_INT_MAX;

  /**
   * Actual items aggregated in the priority queue. Each item is an array
   * with keys "data" and "priority".
   * @var array
   */
  private $items = array();

  /**
   * Add support for deep cloning
   *
   * @return void
   */
  public function __clone() {
    $this->items = Arrays::copy($this->items);
  }

  /**
   * Inserts value with the priority in the queue.
   *
   * @param mixed $value the value to insert
   * @param mixed $priority the associated priority
   */
  public function insert($value, $priority) {
    //echo "$value, $priority";
    $this->items[] = array(
        'data' => $value,
        'priority' => $priority,
    );
    if (!is_array($priority)) {
      $priority = array($priority, $this->serial--);
    }
    parent::insert($value, [$priority, $this->serial--]);
  }

  /**
   * Determines whether the given value is stored
   *
   * @param  mixed $value the value to search for
   * @return boolean true if the given value is stored, false otherwise
   */
  public function contains($value) {
    foreach ($this->items as $item) {
      if ($item['data'] === $value) {
        return true;
      }
    }
    return false;
  }

  public function toArray() {
    $array = [];
    foreach (clone $this as $item) {
      $array[] = $item;
    }
    return $array;
  }

  /**
   * Serialize the data structure
   *
   * @return string
   */
  public function serialize() {
    return serialize($this->items);
  }

  /**
   * Unserialize a string into a PriorityQueue object
   *
   * Serialization format is compatible with {@link Zend\Stdlib\SplPriorityQueue}
   *
   * @param  string $data
   * @return void
   */
  public function unserialize($data) {
    foreach (unserialize($data) as $item) {
      $this->insert($item['data'], $item['priority']);
    }
  }

}
