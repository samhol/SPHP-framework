<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Data\Sports;

use Sphp\DateTime\DateInterface;

/**
 * Implements a HTTP code object collection
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ExerciseDayCollection implements \IteratorAggregate {

  private $days;

  /**
   * Constructor
   */
  public function __construct() {
    $this->days = [];
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->days);
  }

  public function __toString() {
    $output = '';
    foreach ($this as $ex) {
      $output .= "\n$ex";
    }
    return $output;
  }

  public function setDay(ExerciseDay $e) {
    $date = $e->getDate()->format('Y-m-d');
    $this->days[$date] = $e;
    return $this;
  }

  public function getDay($date): ExerciseDay {
    $d = new \Sphp\DateTime\Date($date);
    $key = $d->format('Y-m-d');
    if (!isset($this->days[$key])) {
      $this->days[$key] = new ExerciseDay($d);
    }
    return $this->days[$key];
  }

  /**
   * Returns
   *
   * @param  Exercise $e 
   * @return boolean
   */
  public function contains($date): bool {
    return $this->dateExists($e->getDate()) && $this->dateContainsType($e);
  }

  public function dateExists(DateInterface $date): bool {
    return array_key_exists($date->format('Y-m-d'), $this->days);
  }

  /**
   * Returns
   *
   * @param  Exercise $e
   * @return boolean
   */
  public function dateContainsType(Exercise $e): bool {
    return $this->dateExists($e->getDate()) && array_key_exists($e->getName(), $this->days[$e->getDate()->format('Y-m-d')]);
  }

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current() {
    return current($this->days);
  }

  /**
   * Advance the internal pointer of the collection
   */
  public function next() {
    next($this->days);
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key() {
    return key($this->days);
  }

  /**
   * Rewinds the Iterator to the first element
   */
  public function rewind() {
    reset($this->days);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid(): bool {
    return false !== current($this->days);
  }

  public function getIterator(): \Traversable {
    return new \ArrayIterator($this->days);
  }

}
