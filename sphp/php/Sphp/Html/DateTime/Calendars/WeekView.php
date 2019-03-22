<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\DateTime\Calendars;

use Sphp\Html\AbstractContent;
use Sphp\Html\Flow\Section;
use Sphp\I18n\Datetime\CalendarUtils;
use Sphp\Html\Foundation\Sites\Grids\BasicRow;
use Sphp\Html\PlainContainer;
use Sphp\DateTime\Date;
use Sphp\DateTime\Calendars\Diaries\DiaryContainer;
use Sphp\DateTime\Calendars\Diaries\DiaryInterface;
use Sphp\Html\Foundation\Sites\Containers\Popup;

/**
 * Implements a Month view for a Calendar
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class WeekView extends AbstractContent {

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
   * @param DiaryContainer $diaryContainer
   * @param Popup $popup
   */
  public function __construct(DiaryContainer $diaryContainer = null, Popup $popup = null) {
    if ($diaryContainer === null) {
      $diaryContainer = new DiaryContainer();
    }
    $this->setDiaryContainer($diaryContainer);

    $this->popup = new Popup((new Section())->addCssClass('calendar-date-root'));
    $this->popup->addCssClass('sphp-calendar', 'sphp-date-info');
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->diaries, $this->popup);
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
    $container->append($this->createHead());
    $container->append($this->createWeekRow());
    $container->append($this->popup);
    return $container;
  }

  protected function createHead(): BasicRow {
    $row = new BasicRow();
    $row->cssClasses()->protectValue('sphp', 'calendar-head');
    $cu = new CalendarUtils();
    foreach ($cu->getWeekdays() as $num => $day) {
      $row->append('<div class="head day">
      <span class="show-for-small-only">' . $cu->getWeekdayName($num, 2) . '</span>
      <span class="hide-for-small-only">' . $day . '</span></div>');
    }
    return $row;
  }

  /**
   * Returns a row containing weekday cells
   * 
   * @return BasicRow a row containing weekday cells
   */
  public function createWeekRow(Date $weekday): BasicRow {
    if ($weekday->getWeekDay() !== 1) {
      $monday = $weekday->modify('last monday');
    } else {
      $monday = $weekday;
    }
    $row = new BasicRow();
    $row->cssClasses()->protectValue('sphp', 'calendar-week');
    $row->append($this->createDayCell($monday));
    $next = $monday->nextDay();
    while ($next->getWeekDay() !== 1) {
      $row->append($this->createDayCell($next));
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
    if ($diaryDate->notEmpty()) {
      $weekDayView->setAttribute('data-date', $day->format('Y-m-d'));
      $this->popup->createController($weekDayView);
    }
    return $weekDayView;
  }

  public function getHtml(): string {
    return $this->build()->getHtml();
  }

}
