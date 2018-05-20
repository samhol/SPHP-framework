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
class ExerciseDay implements \Countable {

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
    $output = "$this->date:";
    foreach ($this->exercises as $ex) {
      //print_r($ex);
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

  public function insertWeightAndRepsExersice(string $name, string $category = null): WeightLifting {
    if (!isset($this->exercises[$name])) {
      $this->exercises[$name] = new WeightLifting($name, $category);
    }
    return $this->exercises[$name];
  }

  public function getExercise(string $name): Exercise {
    return $this->exercises[$name];
  }

  /**
   * 
   * @param string $name
   * @param string $category
   * @return WeightLifting
   */
  public function weightLifting(string $name, string $category = null): WeightLifting {
    if (!isset($this->exercises[$name])) {
      $this->exercises[$name] = new WeightLifting($name, $category);
    }
    return $this->exercises[$name];
  }

  /**
   * 
   * @param string $name
   * @param string $category
   * @return DistanceAndTimeExercise
   */
  public function distanceAndTime(string $name, string $category = null): DistanceAndTimeExercise {
    if (!isset($this->exercises[$name])) {
      $this->exercises[$name] = new DistanceAndTimeExercise($name, $category);
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

  public function getIterator(): \Traversable {
    return new \ArrayIterator($this->exercises);
  }

  public function count(): int {
    return count($this->exercises);
  }

}
