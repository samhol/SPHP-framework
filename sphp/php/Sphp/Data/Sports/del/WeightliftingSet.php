<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Data\Sports;

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
  private $set;

  /**
   * @var int
   */
  private $reps;
  

  /**
   * Constructor
   * 
   * @param DateInterface $date
   * @param string $name
   * @param string $category
   * @param float $weight
   * @param int $reps
   */
  public function __construct(float $weight, int $reps) {
    $this->setWeight($weight)->setReps($reps);
  }

  public function getWeight(): float {
    return $this->weight;
  }

  public function getReps(): int {
    return $this->reps;
  }

  public function setWeight(float $weight) {
    $this->set[]['weight'] = $weight;
    $this->set[]['reps'] = $reps;
    return $this;
  }

  public function setReps(int $reps) {
    $this->reps = $reps;
    return $this;
  }

}
