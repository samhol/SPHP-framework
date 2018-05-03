<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\DateTime\Calendars;

use Sphp\Html\AbstractComponent;
use Sphp\I18n\Datetime\CalendarUtils;
use Sphp\Html\Foundation\Sites\Grids\Row;
use Sphp\Html\Div;
use Sphp\Html\Container;
use Sphp\DateTime\Date;
use Sphp\DateTime\Calendars\TraversableCalendar;
use Sphp\DateTime\Calendars\Calendar;

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
   * @var CalendarDateTraversableInterface 
   */
  private $calendar;

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
    $this->firstOf = Date::from("$year-$month-1");
    $this->useCalendar();
  }

  /**
   * 
   * @param  Calendar $cal
   * @return $this
   */
  public function useCalendar(TraversableCalendar $cal = null) {
    if ($cal === null) {
      $cal = new Calendar();
    }
    $this->calendar = $cal;
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
    $next = $monday->jump(7);
    while ($next->format('m') == $this->month) {
      $container->append($this->createWeekRow($next));
      $next = $next->jump(7);
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
    
    $weekDayView = new WeekDayView($this->calendar->get($day));
    //$weekDayView->useCalendaDate($this->calendar->get($day));
    if ($day->getMonth() === $this->month) {
      $weekDayView->addCssClass('selected-month');
    } else {
      $weekDayView->addCssClass('not-selected-month');
    }
    return $weekDayView;
  }

  public function contentToString(): string {
    return $this->build()->getHtml();
  }

}
