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
 * Class BodyWeightSet
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class BodyWeightSet implements ExerciseSet {

  /**
   * @var int 
   */
  private int $reps;

  /**
   * Constructor
   *  
   * @param int $reps repetitions done
   */
  public function __construct(int $reps) {
    $this->reps = $reps;
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
    $arr['reps'] = $this->reps;
    return $arr;
  }

}
