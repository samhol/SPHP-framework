<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\DateTime\Calendars\LogBuilders;

use Sphp\DateTime\Calendars\Diaries\LogInterface;
use Sphp\DateTime\Calendars\Diaries\Holidays\BirthDay;
use Sphp\Html\Container;
use Sphp\DateTime\Calendars\Diaries\Sports\WorkoutLog;

/**
 * Description of LogLayoutBuilder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class LogLayoutBuilder {

  //private $types = [BirthDay::class => '2'];
  private static $instance;

  public function build(\Sphp\DateTime\Calendars\Diaries\DiaryDate $date): Container {
    $ul = new Container();
    $holidays = new HolidayLogBuilder();
    foreach ($date as $log) {
      //$ul->append($this->logLayoutBuilder->build($log));   
      if ($log instanceof \Sphp\DateTime\Calendars\Diaries\Holidays\HolidayInterface) {
        $holidays->insert($log);
        
        //$ul->appendMd($log->toString($date->getYear()));
      } else if ($log instanceof WorkoutLog) {
        $ul->append(new WorkoutLogBuilder($log));
      } else {
        $ul->appendMd($log->toString());
      }
    }
    $ul->append($holidays);
    return $ul;
  }

  /**
   * 
   * @return LogLayoutBuilder
   */
  public static function instance(): LogLayoutBuilder {
    if (self::$instance === null) {
      self::$instance = new static();
    }
    return self::$instance;
  }

}
