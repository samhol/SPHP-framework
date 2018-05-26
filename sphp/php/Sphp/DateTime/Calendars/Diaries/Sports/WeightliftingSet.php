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
 * Description of WeightliftingSet
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class WeightliftingSet {

  /**
   * @var float
   */
  private $weight;

  /**
   * @var int 
   */
  private $reps;

  /**
   * Constructor
   * 
   * @param float $weight
   * @param int $reps
   */
  public function __construct(float $weight, int $reps) {
    $this->setWeight($weight)->setReps($reps);
  }

  public function __toString(): string {
    return sprintf("%skg x %d reps", $this->weight, $this->reps);
  }

  public function getWeight(): float {
    return $this->weight;
  }

  public function getReps(): int {
    return $this->reps;
  }

  public function setWeight(float $weight) {
    $this->weight = $weight;
    return $this;
  }

  public function setReps(int $reps) {
    $this->reps = $reps;
    return $this;
  }

  public function getTotalWeight(): float {
    return $this->reps * $this->weight;
  }

}
