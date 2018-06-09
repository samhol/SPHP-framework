<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries\Sports;

use Sphp\DateTime\Calendars\Diaries\LogInterface;
use IteratorAggregate;
use Countable;
use Sphp\DateTime\Date;

/**
 * Description of ExerciseDy
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class WorkoutLog extends Date implements IteratorAggregate, LogInterface, Countable {

  private $exercises;

  public function __construct($date) {
    parent::__construct($date);
    $this->exercises = [];
  }

  public function __toString(): string {
    $output = parent::__toString() . ':';
    foreach ($this->exercises as $ex) {
      $output .= "\n\t$ex";
    }
    return $output;
  }

  /**
   * 
   * @param  Exercise $e
   * @return $this
   */
  public function setExercise(Exercise $e) {
    $name = $e->getName();
    $this->exercises[$name] = $e;
    return $this;
  }

  public function getExercise(string $name): Exercise {
    return $this->exercises[$name];
  }

  /**
   * Sets a weightlifting exercise if not present and returns the exercise instance
   * 
   * @param  string $name unique name of the exercise
   * @param  string|null $category optional exercise category
   * @return WeightLiftingExercise the instance contained
   * @throws \Sphp\Exceptions\InvalidArgumentException
   * @throws \Sphp\Exceptions\RuntimeException
   */
  public function setWeightLiftingExercise(string $name, string $category = null): WeightLiftingExercise {
    if ($name === '') {
      throw new \Sphp\Exceptions\InvalidArgumentException("Exercise name must contain letters ('$name' given)");
    }
    if (!isset($this->exercises[$name])) {
      $this->exercises[$name] = new WeightLiftingExercise($name, $category);
    }
    if (!$this->exercises[$name] instanceof WeightLiftingExercise) {
      throw new \Sphp\Exceptions\RuntimeException("Exercise '$name' of a different type allready exists in the workout log");
    }
    return $this->exercises[$name];
  }

  /**
   * Sets a timed exercise if not present and returns the exercise instance
   * 
   * @param  string $name unique name of the exercise
   * @param  string|null $category optional exercise category
   * @return TimedExercise the instance contained
   */
  public function setTimedExercise(string $name, string $category = null): TimedExercise {
    if (!isset($this->exercises[$name])) {
      $this->exercises[$name] = new TimedExercise($name, $category);
    }
    return $this->exercises[$name];
  }

  /**
   * Sets a distance and time exercise if not present and returns the exercise instance
   * 
   * @param  string $name
   * @param  string|null $category optional exercise category
   * @return DistanceAndTimeExercise the instance contained
   */
  public function setDistanceAndTimeExercise(string $name, string $category = null): DistanceAndTimeExercise {
    if (!isset($this->exercises[$name])) {
      $this->exercises[$name] = new DistanceAndTimeExercise($name, $category);
    }
    return $this->exercises[$name];
  }

  /**
   * Checks if the log contains given exercise
   *
   * @param  Exercise $exercise exercise to search for
   * @return boolean true if the exercise exists and false otherwise
   */
  public function contains(Exercise $exercise): bool {
    $name = $exercise->getName();
    return array_key_exists($name, $this->exercises) && $exercise == $this->exercises[$name];
  }

  public function dateMatchesWith($date): bool {
    return parent::matchesWith($date);
  }

  public function getIterator(): \Traversable {
    return new \ArrayIterator($this->exercises);
  }

  public function count(): int {
    return count($this->exercises);
  }

  public function eventAsString(): string {
    return $this->__toString();
  }

  /**
   * 
   * @return Exercise[]
   */
  public function toArray(): array {
    return $this->exercises;
  }

}
