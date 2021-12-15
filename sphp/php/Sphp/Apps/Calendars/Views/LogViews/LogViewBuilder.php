<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Calendars\Views\LogViews;

use Sphp\Apps\Calendars\Views\LogViews\Holidays\HolidayLogView;
use Sphp\Html\PlainContainer;
use Sphp\Apps\Calendars\Diaries\DiaryDate;
use Sphp\Apps\Sports\Views\WorkoutLogView;
use Sphp\Apps\Sports\Workouts\Workout;

/**
 * Implements a Log view builder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class LogViewBuilder {
 
  private static ?LogViewBuilder $instance = null;

  /**
   * Returns a HTML object containing log view for a given day
   * 
   * @param  DiaryDate $date
   * @return PlainContainer containing log view for a given day
   */
  public function build(DiaryDate $date): PlainContainer {
    $conntainer = new PlainContainer();
    $conntainer->append('<strong>Week:</strong> ' . $date->getDate()->getWeek());
    if ($date->notEmpty()) {
      $holidays = HolidayLogView::instance();
      //$workouts = WorkoutLogView::instance();
      $eventBuilder = new Events\ScheduleViewBuilder;
      $conntainer->append($holidays->build($date));
      $conntainer->append($eventBuilder->build($date));
      $view = new WorkoutLogView();
      foreach ($date->getByType(Workout::class) as $workout) {
        $conntainer->append($view->build($workout));
      }
    } else {
      //$conntainer->append('No events on this day');
    }
    return $conntainer;
  }

  /**
   * Returns a singleton instance of builder
   * 
   * @return LogViewBuilder a singleton instance of builder
   */
  public static function instance(): LogViewBuilder {
    if (self::$instance === null) {
      self::$instance = new static();
    }
    return self::$instance;
  }

}
