<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\DateTime\Calendars\LogViews;

use Sphp\Html\Content;
use Sphp\DateTime\Calendars\Diaries\Sports\WorkoutLog;
use Sphp\DateTime\Calendars\Diaries\Sports\Exercise;
use Sphp\Html\Foundation\Sites\Containers\Accordions\Accordion;
use Sphp\Html\Foundation\Sites\Containers\Accordions\Pane;
use Sphp\Html\Lists\Ul;
use Sphp\Html\Lists\Ol;

/**
 * Implements a workout log viewer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class WorkoutLogView implements Content {

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
    foreach ($this->workouts as $exercise) {
      $accordion->append($this->buildPane($exercise));
    }
    return $accordion;
  }

  protected function buildPane(Exercise $exercise): Pane {
    $pane = new Pane($exercise->getName());
    if ($exercise->count() === 1) {
      $list = new Ul();
    } else {
      $list = new Ol();
    }
    foreach ($exercise as $set) {
      $list->append($set);
    }
    $pane->append($list);
    return $pane;
  }

  public function getHtml(): string {
    $h = '<h2>Workouts for the day</h2>';
    return $h . $this->buildAccordion()->getHtml();
  }

}
