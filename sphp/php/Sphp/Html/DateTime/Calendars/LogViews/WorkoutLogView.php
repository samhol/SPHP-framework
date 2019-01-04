<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\DateTime\Calendars\LogViews;

use Sphp\DateTime\Calendars\Diaries\Sports\Workouts;
use Sphp\DateTime\Calendars\Diaries\Sports\WeightLiftingExercise;
use Sphp\DateTime\Calendars\Diaries\Sports\DistanceAndTimeExercise;
use Sphp\DateTime\Calendars\Diaries\Sports\TimedExercise;
use Sphp\Html\Flow\Section;
use Sphp\Html\Foundation\Sites\Containers\Accordions\Accordion;
use Sphp\DateTime\Calendars\Diaries\DiaryDate;

/**
 * Implements a workout log viewer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class WorkoutLogView {

  public function build(DiaryDate $date): string {
    $workouts = $date->getByType(Workouts::class);
    //echo $date;
    if ($workouts->notEmpty()) {
      $section = new Section();
      $section->addCssClass('group', 'workouts');
      $section->appendH3('Workouts for the day')->addCssClass('heading');
      foreach ($workouts as $wo) {
        // echo get_class($wo);
        $section->append($this->buildAccordion($wo));
      }
      return $section->getHtml();
    }
    return '';
  }

  /**
   * Builds a Foundation based accordion component containing the example
   * 
   * @param  Workouts $workouts
   * @return Accordion a Foundation based accordion component containing the example
   */
  public function buildAccordion(Workouts $workouts): Accordion {
    $accordion = new Accordion();
    $accordion->allowAllClosed(true)->allowMultiExpand(true);
    $doer = new WeighhtLiftingPaneBuilder();
    $doer1 = new DistanceAndTimePaneBuilder();
    $doer2 = new TimedExercisePaneBuilder();
    $doer3 = new WorkoutPaneBuilder();
    foreach ($workouts as $exercise) {
      if ($exercise instanceof WeightLiftingExercise) {
        $accordion->append($doer->buildPane($exercise));
      } else if ($exercise instanceof DistanceAndTimeExercise) {
        $accordion->append($doer1->buildPane($exercise));
      } else if ($exercise instanceof TimedExercise) {
        $accordion->append($doer2->buildPane($exercise));
      } else {
        $accordion->append($doer3->buildPane($exercise));
      }
    }
    return $accordion;
  }

  /**
   * @var LogViewBuilder|null 
   */
  private static $instance;

  /**
   * Returns a singleton instance of builder
   * 
   * @return LogViewBuilder a singleton instance of builder
   */
  public static function instance(): WorkoutLogView {
    if (self::$instance === null) {
      self::$instance = new static();
    }
    return self::$instance;
  }

}
