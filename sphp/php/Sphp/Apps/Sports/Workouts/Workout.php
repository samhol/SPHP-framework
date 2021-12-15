<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Sports\Workouts;

use Sphp\Apps\Calendars\Diaries\CalendarEntry;
use Sphp\DateTime\Date;
use IteratorAggregate;
use Traversable;
use ArrayIterator;
use Sphp\Stdlib\Datastructures\Arrayable;
use Countable;
use Sphp\DateTime\ImmutableDate;
use Sphp\Apps\Sports\Exceptions\ExerciseException;

/**
 * Implements a workout entry for a diary
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Workout implements IteratorAggregate, CalendarEntry, Countable, Arrayable {

  /**
   * @var Date 
   */
  private Date $date;

  /**
   * @var Exercise[] 
   */
  private array $exercises;

  /**
   * Constructor
   * 
   * @param  Date $date raw date data
   */
  public function __construct(Date $date) {
    $this->date = $date;
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

  /**
   * 
   * @param  Exercise $e
   * @return string
   * @throws ExerciseException
   */
  protected function generateHashForObject(Exercise $e): string {
    return $this->generateHash($e->getName(), get_class($e));
  }

  /**
   * 
   * @param  string $name
   * @param  string $type
   * @return string
   * @throws ExerciseException
   */
  protected function generateHash(string $name, string $type): string {
    if ($name === '') {
      throw new ExerciseException("Exercise name must contain letters ('$name' given)");
    }
    return md5($type . $name);
  }

  /**
   * Sets a new exercise to the log
   * 
   * @param  Exercise $e 
   * @return $this for a fluent interface
   * @throws ExerciseException
   */
  public function setExercise(Exercise $e) {
    $name = $e->getName();
    if ($name === '') {
      throw new ExerciseException("Exercise name must contain letters ('$name' given)");
    }
    $this->exercises[$this->generateHashForObject($e)] = $e;
    return $this;
  }

  /**
   * 
   * @param  string $name
   * @return Exercise
   */
  public function getExercise(string $name): ?Exercise {
    return $this->exercises[$name];
  }

  /**
   * Checks if contains given exercise
   *
   * @param  Exercise $e exercise to search for
   * @return bool true if the exercise exists and false otherwise
   */
  public function containsExercise(Exercise $e): bool {
    return array_key_exists($this->generateHashForObject($e), $this->exercises);
  }

  /**
   * Checks if the log contains given exercise
   *
   * @param  string $name exercise to search for
   * @return bool true if the exercise exists and false otherwise
   */
  public function containsExerciseOfType(string $type, string $name): bool {
    return array_key_exists($this->generateHash($name, $type), $this->exercises);
  }

  /**
   * Sets a distance and time exercise if not present and returns the exercise instance
   * 
   * @param  string $name the unique name of the exercise
   * @param  string|null $category optional exercise category
   * @return Exercise the instance set
   * @throws ExerciseException
   */
  protected function useExercise(string $objectType, string $name, string $category = null): Exercise {
    if ($this->containsExerciseOfType($objectType, $name)) {
      $e = $this->exercises[$this->generateHash($name, $objectType)];
    } else {
      $e = new $objectType($name, $category);
      $this->setExercise($e);
    }
    return $e;
  }

  /**
   * Sets a bodywoight exercise if not present and returns the exercise instance
   * 
   * @param  string $name unique name of the exercise
   * @param  string|null $category optional exercise category
   * @return BodyWeightExercise the instance set
   * @throws ExerciseException
   */
  public function bodyWeightExercise(string $name, string $category = null): BodyWeightExercise {
    return $this->useExercise(BodyWeightExercise::class, $name, $category);
  }

  /**
   * Sets a weightlifting exercise if not present and returns the exercise instance
   * 
   * @param  string $name unique name of the exercise
   * @param  string|null $category optional exercise category
   * @return WeightLiftingExercise the instance set
   * @throws ExerciseException
   */
  public function weightLiftingExercise(string $name, string $category = null): WeightLiftingExercise {
    return $this->useExercise(WeightLiftingExercise::class, $name, $category);
  }

  /**
   * Sets a timed exercise if not present and returns the exercise instance
   * 
   * @param  string $name the unique name of the exercise
   * @param  string|null $category optional exercise category
   * @return TimedExercise the instance set
   * @throws ExerciseException
   */
  public function timedExercise(string $name, string $category = null): TimedExercise {
    return $this->useExercise(TimedExercise::class, $name, $category);
  }

  /**
   * Sets a distance and time exercise if not present and returns the exercise instance
   * 
   * @param  string $name the unique name of the exercise
   * @param  string|null $category optional exercise category
   * @return DistanceAndTimeExercise the instance set
   * @throws ExerciseException
   */
  public function distanceAndTimeExercise(string $name, string $category = null): DistanceAndTimeExercise {
    return $this->useExercise(DistanceAndTimeExercise::class, $name, $category);
  }

  public function dateMatchesWith(Date $date): bool {
    return $this->date->dateEqualsTo($date);
  }

  public function getDate(): ImmutableDate {
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
