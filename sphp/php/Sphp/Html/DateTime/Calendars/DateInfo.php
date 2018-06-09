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
use Sphp\Html\Foundation\Sites\Containers\Modal;
use Sphp\Html\Foundation\Sites\Containers\Popup;
use Sphp\Html\Span;
use Sphp\Html\Media\Icons\FontAwesome;
use Sphp\DateTime\Calendars\Diaries\Holidays\BirthDay;
use Sphp\DateTime\Calendars\Diaries\DiaryDate;
use Sphp\Html\Container;
use Sphp\DateTime\Calendars\Diaries\Sports\WorkoutLog;
/**
 * Description of DateInfo
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class DateInfo implements Content {

  use \Sphp\Html\ContentTrait;

  /**
   * @var DiaryDate 
   */
  private $date;

  /**
   * @var Modal 
   */
  private $modal;

  public function __construct(DiaryDate $calendarDate, $trigger) {
    $this->date = $calendarDate;
    $this->modal = new Modal($trigger, $this->createPopup());
  }

  public function createPopup(): Popup {
    $popup = new Popup();
    $date = $this->date->format('l F jS Y');
    $popup->append("<h2>$date</h2>");
    $popup->append($this->createHolidayNotes());

    $popup->append($this->createNotes());

    //$popup->append($this->calendarDate->getNotes());

    return $popup;
  }

  public function createHolidayNotes(): Container {
    $ul = new Container();
    if (count($this->date->getHolidays()) > 0) {
      $ul->appendMd("**HOLIDAYS:**");
      foreach ($this->date as $log) {
        if ($log instanceof BirthDay) {
          $ul->appendMd($log->eventAsString($this->date->getYear()));
        } else {
          $ul->appendMd($log->eventAsString());
        }
      }
    }
    return $ul;
  }

  public function createNotes(): Container {
    $ul = new Container();
    foreach ($this->date as $log) {
      if ($log instanceof BirthDay) {
        $ul->appendMd($log->eventAsString($this->date->getYear()));
      } else if ($log instanceof WorkoutLog) {
        $ul->append(new Exercises($log));
      } else {
        $ul->appendMd($log->eventAsString());
      }
    }
    return $ul;
  }

  public function create() {
    return $this->modal;
  }

  public function getHtml(): string {
    return $this->modal->getHtml();
  }

}
