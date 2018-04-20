<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\Calendars;
use DateTime;
use Sphp\Html\AbstractComponent;
use Sphp\I18n\Datetime\CalendarUtils;
use DateTimeInterface;
use Sphp\Html\Foundation\Sites\Grids\Row;
use Sphp\Html\Div;
use DateTimeImmutable;
use Sphp\Html\Container;
use Sphp\DateTime\Holidays;
use Sphp\DateTime\Date;

/**
 * Description of Month
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class MonthView extends AbstractComponent {

  /**
   * @var int
   */
  private $year;

  /**
   * @var int
   */
  private $month;

  /**
   * @var Holidays 
   */
  private $holidays;

  /**
   * @var Date 
   */
  private $firstOf;

  /**
   * 
   * @param int $year
   * @param int $month
   */
  public function __construct(int $year = null, int $month = null) {
    parent::__construct('div');
    $this->cssClasses()->protect('sphp', 'calendar-month');
    if ($year === null) {
      $year = (int) date("Y", time());
    }
    if ($month === null) {
      $month = (int) date("m", time());
    }
    $this->month = $month;
    $this->year = $year;
    $this->firstOf = Date::createFromString("$year-$month-1");
  }

  /**
   * 
   * @param  Holidays $holidays
   * @return $this
   */
  public function setHolidays(Holidays $holidays = null) {
    $this->holidays = $holidays;
    return $this;
  }

  protected function build(): Container {
    $container = new Container();
    $container->append($this->generateTop());
    $container->append($this->createHead());
    $container->append($this->parseWeeks());
    return $container;
  }

  protected function generateTop() {
    $output = new Row();
    $output->append(new MonthSelector($this->year, $this->month));
    return $output;
  }

  protected function parseWeeks(): Container {
    $container = new Container();
    if ($this->firstOf->getWeekDay() !== 1) {
      $monday = $this->firstOf->modify('last monday');
    } else {
      $monday = clone $this->firstOf;
    }
    $container->append($this->createWeekRow($monday));
    $next = $monday->modify('+ 7 days');
    while ($next->format('m') == $this->month) {
      $container->append($this->createWeekRow($next));
      $next = $next->modify('+ 7 day');
    }
    return $container;
  }

  protected function createHead() {
    $h = new Row();
    $h->append(new Div());
    $cu = new CalendarUtils();
    $o = '<div class="grid-x">';
    foreach ($cu->getWeekdays() as $num => $day) {
      $o .= '<div class="cell auto">
    <div class="head day">
      <span class="show-for-small-only">' . $cu->getWeekdayName($num, 2) . '</span>
      <span class="hide-for-small-only">' . $day . '</span>
    </div>
  </div>';
    }

    return $o . '</div>';
  }

  private function createWeekRow(Date $date): Row {
    $row = new Row();
    //$weekViewer = new WeekNumberView($date);
    //$row->append($weekViewer)->layout()->setWidths('small-1');
    $row->append($this->createDayCell($date));
    $next = $date->nextDate();
    while ($next->getWeekDay() !== 1) {
      $row->append($this->createDayCell($next));
      $next = $next->nextDate();
    }
    return $row;
  }

  protected function createDayCell(Date $day): WeekDayView {
    $td = new WeekDayView($day);
    $td->useHolidays($this->holidays);
    if ($day->getMonth() === $this->month) {
      $td->addCssClass('selected-month');
    } else {
      $td->addCssClass('not-selected-month');
    }
    return $td;
  }

  public function contentToString(): string {
    return $this->build()->getHtml();
  }

}
