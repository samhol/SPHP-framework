<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\Calendars;

use Sphp\Html\Content;
use Sphp\DateTime\Calendars\CalendarDate;
use Sphp\Html\Foundation\Sites\Containers\Modal;
use Sphp\Html\Foundation\Sites\Containers\Popup;
use Sphp\Html\Span;
use Sphp\Html\Media\Icons\FontAwesome;

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
    foreach ($this->calendarDate->getEvents() as $event) {
      if ($event instanceof \Sphp\DateTime\Calendars\Events\BirthDay) {
        $popup->append("<br>" . $event->eventAsString($this->calendarDate->getDate()->getYear()));
      } else {
      $popup->append("<br>" . $event->eventAsString());
      }
    }
    //$popup->append($this->calendarDate->getNotes());

    return $popup;
  }

  public function create() {
    return $this->modal;
  }

  public function getHtml(): string {
    return $this->modal->getHtml();
  }

}
