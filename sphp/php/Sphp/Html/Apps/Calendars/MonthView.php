<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\Calendars;

use Sphp\Html\AbstractComponent;
use Sphp\I18n\Datetime\CalendarUtils;
use DateTimeInterface;
use Sphp\Html\Foundation\Sites\Grids\Row;
use Sphp\Html\Div;
use DateTimeImmutable;
use Sphp\Html\Container;

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
   * @var DateTimeImmutable 
   */
  private $dateTime;

  /**
   * @var int
   */
  private $month;

  public function __construct($year = null, $month = null) {
    parent::__construct('div');

    $this->cssClasses()->protect('sphp', 'calendar-month');
    if ($year === null) {
      $year = (int) date("Y", time());
    }
    if ($month === null) {
      $month = (int) date("m", time());
    }
    $this->month = $month;
    $dt = new DateTimeImmutable("$year-$month-1");
    $this->dateTime = $dt;
  }

  protected function build() {
    $container = new Container();

    $container->append($this->generateTop());
    $container->append($this->createHead());
    $container->append($this->parseWeeks($this->dateTime));
    return $container;
  }

  protected function generateTop() {
    $output = new Row();
    $output->append(new MonthSelector($this->dateTime));
    return $output;
  }

  protected function parseWeeks(DateTimeInterface $dt) {
    $div = new Container();
    $monday = $this->getMonday($dt);
    $div->append($this->createWeekRow($monday));
    $next = $monday->modify('+ 7 days');
    while ($next->format('m') == $this->month) {
      $div->append($this->createWeekRow($next));
      $next = $next->modify('+ 7 day');
    }
    return $div;
  }

  protected function createHead() {
    $h = new Row();
    $h->append(new Div());
    $cu = new CalendarUtils();
    $o = '<div class="grid-x"><div class="cell small-1"><div class="head week">week</div></div>';
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

  private function createWeekRow(DateTimeInterface $date): Row {
    $monday = $this->getMonday($date);
    $row = new Row();
    $weekViewer = new WeekNumberView($date);
    $row->append($weekViewer)->layout()->setWidths('small-1');
    $day = $monday->format('j');
    $row->append($this->createDayCell($monday));
    $next = $monday->modify('+ 1 day');
    while ($next->format('N') != 1) {
      $day = $next->format('j');
      $row->append($this->createDayCell($next));
      $next = $next->modify('+ 1 day');
    }
    return $row;
  }

  protected function createDayCell(DateTimeInterface $day): WeekDayView {
    $td = new WeekDayView($day);
    if ((int) $day->format('n') === $this->month) {
      $td->addCssClass('selected-month');
    } else {
      $td->addCssClass('not-selected-month');
    }
    return $td;
  }

  public function getMonday(DateTimeInterface $date) {
    if ($date->format('N') != 1) {
      return $date->modify('last monday');
    } else {
      return clone $date;
    }
  }

  public function contentToString(): string {
    return $this->build($this->dateTime)->getHtml();
  }

}
