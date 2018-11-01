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
 * Implements a sports exercise
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class Exercise implements Iterator, Countable {

  /**
   * @var string 
   */
  private $name;

  /**
   * @var string 
   */
  private $category;

  /**
   * @var ExerciseSet[]
   */
  private $sets = [];

  /**
   * Constructor
   * 
   * @param string $name the name of the exercise
   * @param string $category the category of the exercise
   */
  public function __construct(string $name, string $category) {
    $this->name = $name;
    $this->category = $category;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->name, $this->category, $this->sets);
  }

  /**
   * Returns the string representation of the object
   * 
   * @return string the string representation of the object
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __toString(): string {
    $output = "$this->name: ($this->category)";
    foreach ($this->sets as $set) {
      $output .= "\n\t\t$set";
    }
    return $output;
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
  
  abstract public function totalsToString(): string;

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
