<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Data\Sports;

use Iterator;
use Sphp\Stdlib\Datastructures\Collection;
use Sphp\DateTime\DateInterface;

/**
 * Implements a HTTP code object collection
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ExerciseCollection implements \IteratorAggregate {

  private $exercises;

  /**
   * 
   */
  public function __construct() {
    $this->exercises = [];
  }

  public function __toString() {
    $output = '';
    foreach ($this as $ex) {
      $output .= "\n$ex";
    }
    return $output;
  }

  public function insert(Exercise $e) {
    $this->exercises[$e->getDate()->format('Y-m-d')][$e->getName()] = $e;
    return $this;
  }

  /**
   * Returns
   *
   * @param  Exercise $e
   * @return boolean
   */
  public function contains(Exercise $e): bool {
    return $this->dateExists($e->getDate()) && $this->dateContainsType($e);
  }

  public function dateExists(DateInterface $date): bool {
    return array_key_exists($date->format('Y-m-d'), $this->exercises);
  }

  /**
   * Returns
   *
   * @param  Exercise $e
   * @return boolean
   */
  public function dateContainsType(Exercise $e): bool {
    return $this->dateExists($e->getDate()) && array_key_exists($e->getName(), $this->exercises[$e->getDate()->format('Y-m-d')]);
  }

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current() {
    return current($this->exercises);
  }

  /**
   * Advance the internal pointer of the collection
   */
  public function next() {
    next($this->exercises);
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key() {
    return key($this->exercises);
  }

  /**
   * Rewinds the Iterator to the first element
   */
  public function rewind() {
    reset($this->exercises);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid(): bool {
    return false !== current($this->exercises);
  }

  public function getIterator(): \Traversable {
    return new \ArrayIterator(\Sphp\Stdlib\Arrays::flatten($this->exercises));
  }

}
