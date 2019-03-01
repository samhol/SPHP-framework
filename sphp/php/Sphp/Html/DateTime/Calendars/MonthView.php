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
use Sphp\Html\Flow\Section;
use Sphp\I18n\Datetime\CalendarUtils;
use Sphp\Html\Foundation\Sites\Grids\BasicRow;
use Sphp\Html\PlainContainer;
use Sphp\DateTime\Date;
use Sphp\DateTime\Calendars\Diaries\DiaryContainer;
use Sphp\DateTime\Calendars\Diaries\DiaryInterface;
use Sphp\Html\Foundation\Sites\Containers\Popup;
use Sphp\Html\Tags;

/**
 * Implements a Month view for a Calendar
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
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
   * @var Date 
   */
  private $firstOf;

  /**
   * @var DiaryContainer 
   */
  private $diaries;

  /**
   * @var Popup 
   */
  private $popup;

  /**
   * Constructor
   * 
   * @param int $year
   * @param int $month
   */
  public function __construct(int $year = null, int $month = null) {
    parent::__construct('div');
    $this->cssClasses()->protectValue('sphp', 'calendar', 'month');
    if ($year === null) {
      $year = (int) date('Y');
    }
    if ($month === null) {
      $month = (int) date('m');
    }
    $this->month = $month;
    $this->year = $year;
    $this->firstOf = Date::from("$year-$month-1");
    $this->diaries = new DiaryContainer();

    $this->popup = new Popup((new Section())->addCssClass('calendar-date-root'));
    $this->popup->addCssClass('sphp', 'calendar', 'date-info');
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

  protected function build(): PlainContainer {
    $container = new PlainContainer();
    $container->append($this->generateTop());
    $container->append($this->createHead());
    $container->append($this->parseWeeks());
    $container->append($this->popup);
    return $container;
  }

  protected function generateTop(): BasicRow {
    $top = MonthSelector::fromDate($this->firstOf);
    //$top->attributes()->classes()->protect('sphp', 'month-selector');
    //$top->append($this->firstOf->format('F Y'));
    $output = new BasicRow();
    $output->appendCell($top)->auto();
    return $output;
  }

  /**
   * 
   * @return PlainContainer
   */
  protected function parseWeeks(): PlainContainer {
    $container = new PlainContainer();
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

  protected function createHead(): BasicRow {
    $row = new BasicRow();
    $row->addCssClass('head');
    $cu = new CalendarUtils();
    foreach ($cu->getWeekdays() as $num => $day) {
      $div = Tags::div();
      $div->addCssClass('week-day-name', strtolower($day));
      $div->append('<span class="show-for-small-only">' . $cu->getWeekdayName($num, 2) . '</span>');
      $div->append('<span class="hide-for-small-only">' . $day . '</span>');
      $row->appendCell($div);
    }
    return $row;
  }

  /**
   * Returns a row containing weekday cells
   * 
   * @param  Date $date
   * @return BasicRow a row containing weekday cells
   */
  private function createWeekRow(Date $date): BasicRow {
    $row = new BasicRow();
    $row->addCssClass('sphp', 'week-row');
    $row->appendCell($this->createDayCell($date));
    $next = $date->nextDay();
    while ($next->getWeekDay() !== 1) {
      $row->appendCell($this->createDayCell($next));
      $next = $next->nextDay();
    }
    return $row;
  }

  /**
   * 
   * @param  Date $day
   * @return WeekDayView
   */
  protected function createDayCell(Date $day): WeekDayView {
    $diaryDate = $this->diaries->getDate($day);
    $weekDayView = new WeekDayView($diaryDate);
    if ($day->getMonth() === $this->month) {
      $weekDayView->addCssClass('selected-month');
    } else {
      $weekDayView->addCssClass('not-selected-month');
    }
    if ($diaryDate->notEmpty()) {
      $weekDayView->setAttribute('data-date', $day->format('Y-m-d'));
      $this->popup->createController($weekDayView);
    }
    return $weekDayView;
  }

  public function contentToString(): string {
    return $this->build()->getHtml();
  }

}
