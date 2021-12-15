<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Sports\Workouts;

/**
 * Class BodyWeightExercise
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class BodyWeightExercise extends Exercise {

  /**
   * Adds a new set to the exercise
   *  
   * @param  int $reps
   * @return BodyWeightSet added set instance
   */
  public function addSet(int $reps): BodyWeightSet {
    $set = new BodyWeightSet($reps);
    $this->insertSet($set);
    return $set;
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

  public function getTotals(): array {
    $totals['sets'] = $this->count();
    $totals['total reps'] = $this->getTotalReps();
    return $totals;
  }

}
