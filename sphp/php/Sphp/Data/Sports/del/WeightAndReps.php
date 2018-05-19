<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Data\Sports;
use Sphp\DateTime\DateInterface;
/**
 * Description of WeightAndReps
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class WeightAndReps extends Exercise {

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
   * @param DateInterface $date
   * @param string $name
   * @param string $category
   * @param float $weight
   * @param int $reps
   */
  public function __construct(DateInterface $date, string $name, string $category, float $weight, int $reps) {
    parent::__construct($date, $name, $category);
    $this->setWeight($weight)->setReps($reps);
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

}
