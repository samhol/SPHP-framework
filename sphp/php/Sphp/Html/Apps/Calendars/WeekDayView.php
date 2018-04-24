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
use DateTimeInterface;
use Sphp\Html\Div;
use Sphp\Html\TimeTag;
use Sphp\DateTime\Date;
use Sphp\DateTime\Calendars\Calendar;
use Sphp\Html\Foundation\Sites\Containers\Modal;
use Sphp\Html\Attributes\ClassAttribute;
use Sphp\Html\CssClassifiableContent;
use Sphp\DateTime\Calendars\CalendarDate;

/**
 * Description of WeekDay
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class WeekDayView implements CssClassifiableContent {

  use \Sphp\Html\ContentTrait,
      \Sphp\Html\CssClassifiableTrait;

  /**
   * @var Div
   */
  private $container;

  /**
   * @var CalendarDate
   */
  private $calendarDate;

  public function __construct(CalendarDate $date) {
    $this->calendarDate = $date;
    $this->container = new Div();
    $this->container->attributes()->classes()->protect('sphp', 'calendar-day');
  }

  public function cssClasses(): ClassAttribute {
    return $this->container->cssClasses();
  }

  protected function buildInfo() {
    if ($this->calendarDate->hasInfo()) {
      $dateInfo = new DateInfo($this->calendarDate);
      $modal = $dateInfo->create();
      //$modal->getTrigger()->addCssClass('float-center');
      $this->container->append($modal);
    }

    if ($this->calendarDate->getInfo()->isNationalHoliday()) {
      $this->container->cssClasses()->protect('holiday');
    }
    return $this;
  }

  protected function buildDate() {
    $timeTag = new TimeTag($this->calendarDate->getDate()->getDateTime(), $this->calendarDate->format('j'));
    $timeTag->setAttribute('title', $this->calendarDate->format('l, Y-m-d'));
    if ($this->calendarDate->getWeekDay() === 1) {
      $this->container->append("<div class=\"week-nr\">{$this->calendarDate->getWeek()}</div>");
    }
    if ($this->calendarDate->isCurrent()) {
      $this->container->cssClasses()->protect('today');
    }
    $this->container->append($timeTag);
    $this->buildInfo();
    $this->container->cssClasses()->protect(strtolower($this->calendarDate->format('l')));
    return $this;
  }

  public function getHtml(): string {
    $this->buildDate();
    return $this->container->getHtml();
  }

}
