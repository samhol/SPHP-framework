<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries\Sports;

use Iterator;
use Countable;

/**
 * Description of WeightLifting
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class WeightLiftingExercise extends Exercise implements Iterator, Countable {

  /**
   * @var WeightliftingSet[]
   */
  private $sets = [];

  public function __destruct() {
    parent::__destruct();
    unset($this->sets);
  }

  public function __toString(): string {
    $output = parent::__toString() . ' total weight: ' . $this->getTotalWeight() . 'kg';
    foreach ($this->sets as $set) {
      $output .= "\n\t\t$set";
    }
    return $output;
  }

  public function getSets(): int {
    return $this->sets;
  }

  public function addSet(float $weight, int $reps) {
    $this->sets[] = new WeightliftingSet($weight, $reps);
    return $this;
  }

  public function count(): int {
    return count($this->sets);
  }

  public function getTotalWeight(): float {
    $total = 0;
    foreach ($this->sets as $set) {
      $total += $set->getTotalWeight();
    }
    return $total;
  }

  /**
   * Returns the current note
   * 
   * @return mixed the current note
   */
  public function current() {
    return current($this->sets);
  }

  /**
   * Advance the internal pointer of the collection
   * 
   * @return void
   */
  public function next() {
    next($this->sets);
  }

  /**
   * Return the key of the current note
   * 
   * @return mixed the key of the current note
   */
  public function key() {
    return key($this->sets);
  }

  /**
   * Rewinds the Iterator to the first element
   * 
   * @return void
   */
  public function rewind() {
    reset($this->sets);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid(): bool {
    return false !== current($this->sets);
  }

}
