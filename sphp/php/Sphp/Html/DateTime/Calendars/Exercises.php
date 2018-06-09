<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\DateTime\Calendars;

use Sphp\Html\Content;
use Sphp\DateTime\Calendars\Diaries\Sports\WorkoutLog;
use Sphp\Html\Foundation\Sites\Containers\Accordions\Accordion;
use Sphp\Html\Foundation\Sites\Containers\Accordions\Pane;

/**
 * Description of Exercises
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Exercises implements Content {

  use \Sphp\Html\ContentTrait;

  /**
   * @var WorkoutLog 
   */
  private $workouts;

  /**
   * Constructor
   *
   * @param WorkoutLog $workouts
   */
  public function __construct(WorkoutLog $workouts) {
    $this->workouts = $workouts;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->workouts);
  }

  /**
   * Builds a Foundation based accordion component containing the example
   * 
   * @return Accordion a Foundation based accordion component containing the example
   */
  public function buildAccordion(): Accordion {
    $accordion = new Accordion();
    foreach ($this->workouts->toArray() as $workout) {
      $pane = new Pane($workout->getName());
      $pane->append($workout);
      $accordion->append($pane);
    }
    return $accordion;
  }

  public function getHtml(): string {
    return $this->buildAccordion()->getHtml();
  }

}
