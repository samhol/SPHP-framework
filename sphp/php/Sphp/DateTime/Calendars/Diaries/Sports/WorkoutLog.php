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
use Sphp\Stdlib\Datastructures\Arrayable;
use Countable;
use Sphp\DateTime\Date;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Exceptions\RuntimeException;

/**
 * Implements a workout log for a diary
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class WorkoutLog implements IteratorAggregate, LogInterface, Countable, Arrayable {

  /**
   * @var Date 
   */
  private $date;

  /**
   * @var Exercise[] 
   */
  private $exercises;

  /**
   * Constructor
   * 
   * @param  DateInterface|\DateTimeInteface|string|int|null $date raw date data
   */
  public function __construct($date) {
    $this->date = Date::from($date);
    $this->exercises = [];
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->date, $this->exercises);
  }

  public function __toString(): string {
    $output = '';
    foreach ($this->exercises as $ex) {
      $output .= "\n\t$ex";
    }
    return $output;
  }

  /**
   * Sets a new exercise to the log
   * 
   * @param  Exercise $e 
   * @return $this for a fluent interface
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
   * @throws InvalidArgumentException
   * @throws RuntimeException
   */
  public function setWeightLiftingExercise(string $name, string $category = null): WeightLiftingExercise {
    if ($name === '') {
      throw new InvalidArgumentException("Exercise name must contain letters ('$name' given)");
    }
    if (!isset($this->exercises[$name])) {
      $this->exercises[$name] = new WeightLiftingExercise($name, $category);
    }
    if (!$this->exercises[$name] instanceof WeightLiftingExercise) {
      throw new RuntimeException("Exercise '$name' of a different type allready exists in the workout log");
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
    return $this->date->dateEqualsTo($date);
  }

  public function getIterator(): \Traversable {
    return new \ArrayIterator($this->exercises);
  }

  public function count(): int {
    return count($this->exercises);
  }

  public function toString(): string {
    return $this->__toString();
  }

  public function toArray(): array {
    return $this->exercises;
  }

}
