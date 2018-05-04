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
use Sphp\DateTime\Calendars\CalendarDate;
use Sphp\Html\Foundation\Sites\Containers\Modal;
use Sphp\Html\Foundation\Sites\Containers\Popup;
use Sphp\Html\Span;
use Sphp\Html\Media\Icons\FontAwesome;
use Sphp\DateTime\Calendars\Events\BirthDay;

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
   * @var CalendarDate 
   */
  private $calendarDate;

  /**
   * @var Modal 
   */
  private $modal;

  public function __construct(CalendarDate $calendarDate, $trigger) {
    $this->calendarDate = $calendarDate;
    $this->modal = new Modal($trigger, $this->createPopup());
  }

  public function createPopup(): Popup {
    $popup = new Popup();
    $date = $this->calendarDate->getDate()->format('l F jS Y');
    $popup->append("<h2>$date</h2>");
    $popup->append($this->createHolidayNotes());

    $popup->append($this->createNotes());

    //$popup->append($this->calendarDate->getNotes());

    return $popup;
  }

  public function createHolidayNotes(): \Sphp\Html\Lists\Ul {
    $ul = new \Sphp\Html\Lists\Ul();
    if (count($this->calendarDate->getEvents()->getHolidays()) > 0) {
      $ul->appendMd("**HOLIDAYS:**");
      foreach ($this->calendarDate->getEvents()->getHolidays() as $event) {
        if ($event instanceof BirthDay) {
          $ul->appendMd($event->eventAsString($this->calendarDate->getDate()->getYear()));
        } else {
          $ul->appendMd($event->eventAsString());
        }
      }
    }
    return $ul;
  }

  public function createNotes(): \Sphp\Html\Lists\Ul {
    $ul = new \Sphp\Html\Lists\Ul();
    foreach ($this->calendarDate->getEvents()->getNotes() as $event) {
      if ($event instanceof BirthDay) {
        $ul->appendMd($event->eventAsString($this->calendarDate->getDate()->getYear()));
      } else {
        $ul->appendMd($event->eventAsString());
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
