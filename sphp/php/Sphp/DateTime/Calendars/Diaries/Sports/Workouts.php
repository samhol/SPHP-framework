<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries\Sports;

use Sphp\DateTime\Calendars\Diaries\CalendarEntry;
use IteratorAggregate;
use Traversable;
use ArrayIterator;
use Sphp\Stdlib\Datastructures\Arrayable;
use Countable;
use Sphp\DateTime\Date;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Implements a workout entry for a diary
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Workouts implements IteratorAggregate, CalendarEntry, Countable, Arrayable {

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

  /**
   * Clone method
   */
  public function __clone() {
    $this->date = clone $this->date;
    $this->exercises = clone $this->exercises;
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
   * @throws InvalidArgumentException
   */
  public function setExercise(Exercise $e) {
    $name = $e->getName();
    if ($name === '') {
      throw new InvalidArgumentException("Exercise name must contain letters ('$name' given)");
    }
    $this->exercises[$name] = $e;
    return $this;
  }

  /**
   * 
   * @param  string $name
   * @return Exercise
   */
  public function getExercise(string $name): Exercise {
    return $this->exercises[$name];
  }

  /**
   * Checks if the log contains given exercise
   *
   * @param  string $name exercise to search for
   * @return boolean true if the exercise exists and false otherwise
   */
  public function containsExercise(string $name): bool {
    return array_key_exists($name, $this->exercises);
  }

  /**
   * Sets a weightlifting exercise if not present and returns the exercise instance
   * 
   * @param  string $name unique name of the exercise
   * @param  string|null $category optional exercise category
   * @return WeightLiftingExercise the instance set
   * @throws InvalidArgumentException
   */
  public function weightLiftingExercise(string $name, string $category = null): WeightLiftingExercise {
    if ($this->containsExercise($name)) {
      $e = $this->getExercise($name);
      if (!$e instanceof WeightLiftingExercise) {
        throw new InvalidArgumentException;
      }
    } else {
      $e = new WeightLiftingExercise($name, $category);
      $this->setExercise($e);
    }
    return $e;
  }

  /**
   * Sets a timed exercise if not present and returns the exercise instance
   * 
   * @param  string $name the unique name of the exercise
   * @param  string|null $category optional exercise category
   * @return TimedExercise the instance set
   * @throws InvalidArgumentException
   */
  public function timedExercise(string $name, string $category = null): TimedExercise {
    if ($this->containsExercise($name)) {
      $e = $this->getExercise($name);
      if (!$e instanceof TimedExercise) {
        throw new InvalidArgumentException;
      }
    } else {
      $e = new TimedExercise($name, $category);
      $this->setExercise($e);
    }
    return $e;
  }

  /**
   * Sets a distance and time exercise if not present and returns the exercise instance
   * 
   * @param  string $name the unique name of the exercise
   * @param  string|null $category optional exercise category
   * @return DistanceAndTimeExercise the instance set
   */
  public function distanceAndTimeExercise(string $name, string $category = null): DistanceAndTimeExercise {
    if ($this->containsExercise($name)) {
      $e = $this->getExercise($name);
      if (!$e instanceof DistanceAndTimeExercise) {
        throw new InvalidArgumentException;
      }
    } else {
      $e = new DistanceAndTimeExercise($name, $category);
      $this->setExercise($e);
    }
    return $e;
  }

  public function dateMatchesWith($date): bool {
    return $this->date->dateEqualsTo($date);
  }

  public function getDate(): Date {
    return $this->date;
  }

  public function getIterator(): Traversable {
    return new ArrayIterator($this->exercises);
  }

  public function count(): int {
    return count($this->exercises);
  }

  public function toArray(): array {
    return $this->exercises;
  }

}
