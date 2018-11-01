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
   * @return WeightliftingSet new instance
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
    foreach ($this as $set) {
      $total += $set->getTotalWeight();
    }
    return $total;
  }

  /**
   * Returns the total reps made in the exercise
   * 
   * @return float the total reps made
   */
  public function getTotalReps(): float {
    $total = 0;
    foreach ($this as $set) {
      $total += $set->getReps();
    }
    return $total;
  }

  public function totalsToString(): string {
    $output = "Totals: \n";
    $output .= "\n\tweight: {$this->getTotalWeight()} kg\n\treps:{$this->getTotalReps()}";
    return $output;
  }

}
