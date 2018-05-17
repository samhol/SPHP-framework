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
class DailyGroup extends Exercise {

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
  public function __construct(DateInterface $date, string $name, string $category) {
    parent::__construct($date, $name, $category);
  }

  public function getSets(): int {
    return $this->set;
  }

  public function addSet(float $weight, int $reps) {
    $this->set[] = new WeightliftingSet($weight, $reps);
    return $this;
  }

}
