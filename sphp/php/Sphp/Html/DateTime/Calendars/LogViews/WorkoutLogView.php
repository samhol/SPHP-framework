<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\DateTime\Calendars\LogViews;

use Sphp\DateTime\Calendars\Diaries\Sports\WorkoutLog;
use Sphp\DateTime\Calendars\Diaries\Sports\Exercise;
use Sphp\Html\Flow\Section;
use Sphp\Html\Foundation\Sites\Containers\Accordions\Accordion;
use Sphp\Html\Foundation\Sites\Containers\Accordions\Pane;
use Sphp\Html\Lists\Ul;
use Sphp\Html\Lists\Ol;
use Sphp\DateTime\Calendars\Diaries\DiaryDate;
use Sphp\Html\Tags;

/**
 * Implements a workout log viewer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class WorkoutLogView {

  public function build(DiaryDate $date): string {
    $workouts = $date->getByType(WorkoutLog::class);
    if ($workouts->notEmpty()) {
      $section = new Section();
      $section->addCssClass('workouts');
      $section->appendH3('Workouts for the day');
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
   * @return Accordion a Foundation based accordion component containing the example
   */
  public function buildAccordion(WorkoutLog $workouts): Accordion {
    $accordion = new Accordion();
    $accordion->allowAllClosed(true)->allowMultiExpand(true);
    $doer = new WeighhtLiftingPaneBuilder();
    $doer1 = new DistanceAndTimePaneBuilder();
    foreach ($workouts as $exercise) {
      if ($exercise instanceof \Sphp\DateTime\Calendars\Diaries\Sports\WeightLiftingExercise) {
        $accordion->append($doer->buildPane($exercise));
      } else if ($exercise instanceof \Sphp\DateTime\Calendars\Diaries\Sports\DistanceAndTimeExercise) {
        $accordion->append($doer1->buildPane($exercise));
      } else {
        $accordion->append($this->buildPane($exercise));
      }
    }
    return $accordion;
  }

  protected function buildPane(Exercise $exercise): Pane {
    $pane = new Pane($this->createPaneTitle($exercise));
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

  protected function createPaneTitle(Exercise $exercise): \Sphp\Html\Span {
    $title = Tags::span($exercise->getName());
    $title->append(Tags::strong(" ({$exercise->getDescription()})"));
    if ($exercise instanceof \Sphp\DateTime\Calendars\Diaries\Sports\WeightLiftingExercise) {
      $title->append($exercise->getTotalWeight());
    }
    return $title;
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
