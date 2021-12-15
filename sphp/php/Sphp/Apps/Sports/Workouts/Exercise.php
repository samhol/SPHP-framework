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

use IteratorAggregate;
use Traversable;
use ArrayIterator;
use Countable;

/**
 * Implements a sports exercise
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class Exercise implements IteratorAggregate, Countable {

  /**
   * @var string 
   */
  private string $name;

  /**
   * @var string 
   */
  private string $category;

  /**
   * @var ExerciseSet[]
   */
  private array $sets;

  /**
   * Constructor
   * 
   * @param string $name the name of the exercise
   * @param string $category the category of the exercise
   */
  public function __construct(string $name, string $category) {
    $this->name = $name;
    $this->category = $category;
    $this->sets = [];
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->sets);
  }

  /**
   * Returns the name of the exercise
   * 
   * @return string exercise name
   */
  public function getName(): string {
    return $this->name;
  }

  /**
   * Returns the description of the exercise
   * 
   * @return string the description of the exercise
   */
  public function getDescription(): string {
    return $this->category;
  }

  /**
   * Returns exercise sets
   * 
   * @return ExerciseSet[] exercise sets
   */
  public function getSets(): array {
    return $this->sets;
  }

  /**
   * Inserts a new set to the exercise
   * 
   * @param ExerciseSet new exercise set
   */
  protected function insertSet(ExerciseSet $set) {
    $this->sets[] = $set;
    return $this;
  }

  /**
   * Returns the number of the sets in the exercise
   * 
   * @return int the number of the sets in the exercise
   */
  public function count(): int {
    return count($this->sets);
  }

  /**
   * 
   * @return string[]
   */
  public function getSetNames(): array {
    $keys = [];
    if ($this->count() > 0) {
      $keys = array_keys($this->sets[0]->toArray());
    }
    return $keys;
  }

  public function setsToArray(): array {
    $sets = [];
    foreach ($this as $set) {
      $sets[] = $set->toArray();
    }
    return $sets;
  }

  public function getIterator(): Traversable {
    return new ArrayIterator($this->sets);
  }
  
  abstract public function getTotals(): array  ;

}
