<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Sports\Views\Utils;

use Sphp\Apps\Sports\Workouts\Workout;
use Sphp\Bootstrap\Components\Accordions\Accordion;
/**
 * The WorkoutViews class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class WorkoutViews {

  /**
   * @var Workout
   */
  private $workout;

  /**
   * Constructor
   * 
   * @param Workout $workout
   */
  public function __construct(Workout $workout) {
    $this->workout = $workout;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->workout);
  }

  public function buidExerciseAccordion(): Accordion {
    $accordion = new Accordion();
    foreach ($this->workout as $exercise) {
      $builder = new ExerciseViews($exercise);
      $accordion->append($builder->buildPane());
    }
    return $accordion;
  }

}
