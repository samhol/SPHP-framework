<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries\Sports;

/**
 * Implements a weightlifting exercise
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class WeightLiftingExercise extends Exercise {

  /**
   * Adds a new set to the exercise
   * 
   * @param  float $weight
   * @param  int $reps
   * @return WeightliftingSet added set instance
   */
  public function addSet(float $weight, int $reps): WeightliftingSet {
    $set = new WeightliftingSet($weight, $reps);
    $this->insertSet($set);
    return $set;
  }

  /**
   * Returns the total weight used in the exercise
   * 
   * @return float the total weight used
   */
  public function getTotalWeight(): float {
    $total = 0;
    foreach ($this->getSets() as $set) {
      $total += $set->getTotalWeight();
    }
    return $total;
  }

  /**
   * Returns the total reps made in the exercise
   * 
   * @return int the total reps made
   */
  public function getTotalReps(): int {
    $total = 0;
    foreach ($this->getSets() as $set) {
      $total += $set->getReps();
    }
    return $total;
  }

}
