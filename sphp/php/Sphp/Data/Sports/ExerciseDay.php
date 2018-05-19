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
 * Description of ExerciseDy
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ExerciseDay {

  private $exercises;

  /**
   * @var DateInterface 
   */
  private $date;

  /**
   * 
   */
  public function __construct(\Sphp\DateTime\Date $d) {
    $this->exercises = [];
    $this->date = $d;
  }

  public function __toString() {
    $output = "$this->date:\n";
    foreach ($this as $ex) {
      $output .= "\n\t$ex";
    }
    return $output;
  }

  function getDate(): DateInterface {
    return $this->date;
  }

  function setDate(DateInterface $date) {
    $this->date = $date;
  }

  public function insert(Exercise $e) {
    $name = $e->getName();
    $this->exercises[$name] = $e;
    return $this;
  }

  public function getExercise(string $name): Exercise {
    return $this->exercises[$name];
  }

  public function weightLifting(string $name, string $category = null): WeightLifting {
    if (!isset($this->exercises[$name])) {
      $this->exercises[$name] = new WeightLifting($name, $category);
    }
    return $this->exercises[$name];
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
