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
use Sphp\DateTime\DateWrapper;
use Sphp\DateTime\Calendars\Diaries\DiaryContainer;
use Sphp\DateTime\Calendars\Diaries\DiaryInterface;

/**
 * Implements a Month view for a Calendar
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
   * @var DateWrapper 
   */
  private $firstOf;

  /**
   * @var DiaryContainer 
   */
  private $diaries;

  /**
   * Constructor
   * 
   * @param int $year
   * @param int $month
   */
  public function __construct(int $year = null, int $month = null) {
    parent::__construct('div');
    $this->cssClasses()->protect('sphp', 'calendar-month');
    if ($year === null) {
      $year = (int) date('Y', time());
    }
    if ($month === null) {
      $month = (int) date('m', time());
    }
    $this->month = $month;
    $this->year = $year;
    $this->firstOf = DateWrapper::from("$year-$month-1");
    $this->diaries = new DiaryContainer();
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->diaries, $this->firstOf);
  }

  /**
   * Returns the diary container used
   * 
   * @return DiaryContainer the diary container used
   */
  public function getDiaries(): DiaryContainer {
    return $this->diaries;
  }

  /**
   * Sets the diary container used
   * 
   * @param  DiaryContainer $diaryContainer
   * @return $this for a fluent interface
   */
  public function setDiaryContainer(DiaryContainer $diaryContainer) {
    $this->diaries = $diaryContainer;
    return $this;
  }

  /**
   * 
   * @param  DiaryInterface $diary
   * @return $this for a fluent interface
   */
  public function insertDiary(DiaryInterface $diary) {
    $this->getDiaries()->insertDiary($diary);
    return $this;
  }

  protected function build(): Container {
    $container = new Container();
    $container->append($this->generateTop());
    $container->append($this->createHead());
    $container->append($this->parseWeeks());
    return $container;
  }

  protected function generateTop(): Row {
    $top = MonthSelector::fromDate($this->firstOf);
    //$top->attributes()->classes()->protect('sphp', 'month-selector');
    //$top->append($this->firstOf->format('F Y'));
    $output = new Row();
    $output->append($top);
    return $output;
  }

  /**
   * 
   * @return Container
   */
  protected function parseWeeks(): Container {
    $container = new Container();
    if ($this->firstOf->getWeekDay() !== 1) {
      $monday = $this->firstOf->modify('last monday');
    } else {
      $monday = clone $this->firstOf;
    }
    $container->append($this->createWeekRow($monday));
    $next = $monday->jumpDays(7);
    while ($next->format('m') == $this->month) {
      $container->append($this->createWeekRow($next));
      $next = $next->jumpDays(7);
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

  /**
   * 
   * @param  DateWrapper $date
   * @return Row
   */
  private function createWeekRow(DateWrapper $date): Row {
    $row = new Row();
    $row->append($this->createDayCell($date));
    $next = $date->nextDay();
    while ($next->getWeekDay() !== 1) {
      $row->append($this->createDayCell($next));
      $next = $next->nextDay();
    }
    return $row;
  }

  /**
   * 
   * @param  DateWrapper $day
   * @return WeekDayView
   */
  protected function createDayCell(DateWrapper $day): WeekDayView {
    $weekDayView = new WeekDayView($this->diaries->getDate($day));
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
