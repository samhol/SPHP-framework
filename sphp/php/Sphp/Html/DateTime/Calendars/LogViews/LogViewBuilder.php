<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\DateTime\Calendars\LogViews;

use Sphp\Html\Container;
use Sphp\DateTime\Calendars\Diaries\DiaryDate;
use Sphp\DateTime\Calendars\Diaries\Sports\WorkoutLog;
use Sphp\DateTime\Calendars\Diaries\Holidays\HolidayInterface;

/**
 * Implements a Log view builder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class LogViewBuilder {

  /**
   * @var LogViewBuilder|null 
   */
  private static $instance;

  /**
   * Returns a HTML object containing log view for a given day
   * 
   * @param  DiaryDate $date
   * @return Container containing log view for a given day
   */
  public function build(DiaryDate $date): Container {
    $conntainer = new Container();
    $holidays = new HolidayLogView();
    foreach ($date as $log) {
      if ($log instanceof HolidayInterface) {
        $holidays->insert($log);
      } else if ($log instanceof WorkoutLog) {
        $conntainer->append(new WorkoutLogView($log));
      } else {
        $conntainer->appendMd($log->toString());
      }
    }
    $conntainer->append($holidays);
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
