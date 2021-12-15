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

/**
 * Implements a weightlifting set
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class WeightliftingSet implements ExerciseSet {

  /**
   * @var float (in kg)
   */
  private float $weight;

  /**
   * @var int 
   */
  private int $reps;

  /**
   * Constructor
   * 
   * @param float $weight weight used in the set (in kg)
   * @param int $reps repetitions done
   */
  public function __construct(float $weight, int $reps) {
    $this->weight = $weight;
    $this->reps = $reps;
  }

  /**
   * Returns the rep weight used in the set
   * 
   * @return float rep weight used in the set (in kilograms)
   */
  public function getRepWeight(): float {
    return $this->weight;
  }

  /**
   * Returns the total weight used in the set
   * 
   * @return float the total weight used in the set (in kilograms)
   */
  public function getTotalWeight(): float {
    return $this->reps * $this->weight;
  }

  /**
   * Returns the repetitions done in the set
   * 
   * @return int the repetitions done in the set
   */
  public function getReps(): int {
    return $this->reps;
  }

  public function toArray(): array {
    $arr = [];
    $arr['weight'] = "$this->weight kg";
    $arr['reps'] = $this->reps;
    $arr['total'] = $this->getTotalWeight() . ' kg';
    return $arr;
  }

}
