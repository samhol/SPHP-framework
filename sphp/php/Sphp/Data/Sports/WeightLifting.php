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
 * Description of WeightLifting
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class WeightLifting extends Exercise implements \Countable {

  /**
   * @var WeightliftingSet[]
   */
  private $set = [];

  /**
   * Constructor
   * 
   * @param DateInterface $date
   * @param string $name
   * @param string $category
   * @param float $weight
   * @param int $reps
   */
  public function __construct(string $name, string $category) {
    parent::__construct($name, $category);
  }

  public function __toString(): string {
    $output = parent::__toString() . ' total weight: ' . $this->getTotalWeight()  .'kg';
    foreach ($this->set as $set) {
      $output .= "\n\t\t$set";
    }
    return $output;
  }

  public function getSets(): int {
    return $this->set;
  }

  public function addSet(float $weight, int $reps) {
    $this->set[] = new WeightliftingSet($weight, $reps);
    return $this;
  }

  public function count(): int {
    return count($this->set);
  }

  public function getTotalWeight(): float {
    $total = 0;
    foreach ($this->set as $set) {
      $total += $set->getTotalWeight();
    }
    return $total;
  }

}
