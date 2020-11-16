<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Calendars;

use Sphp\Html\AbstractComponent;
use Sphp\DateTime\Periods;
use Sphp\Html\Tags;
use Sphp\Html\Foundation\Sites\Grids\BlockGrid;
use Sphp\I18n\Datetime\CalendarUtils;
use Sphp\Html\Foundation\Sites\Containers\Popup;

/**
 * Class MonthView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class MonthView extends AbstractComponent implements \IteratorAggregate {

  private $days;
  private $year;
  private $month;

  /**
   * @var Popup 
   */
  private $popup;

  public function __construct(int $year, int $month) {
    $this->year = $year;
    $this->month = $month;
    $this->popup = new Popup((new \Sphp\Html\Div())->addCssClass('calendar-date-popup'));
    $this->popup->addCssClass('sphp', 'calendar', 'date-info');
    $this->parseDays();
    parent::__construct('div');
    $this->addCssClass('calendar', 'statistics');
  }

  public function __destruct() {
    unset($this->popup, $this->days);
  }

  protected function parseDays(): void {
    $this->days = [];
    foreach (Periods::weeksOfMonth($this->getMonth(), $this->getYear(), 'P1D') as $day) {
      $dayView = new DayView($day);
      $this->days[$day->format('Y-m-d')] = $dayView;
      //$this->popup->createController($dayView);
      $dayView->setAttribute('data-date', $day->format('Y-m-d'));
      $this->popup->createController($dayView);
    }
  }

  public function getYear(): int {
    return $this->year;
  }

  public function getMonth(): int {
    return $this->month;
  }

  public function getPopup(): Popup {
    return $this->popup;
  }

  private function parseMonth(): BlockGrid {
    $cont = new BlockGrid();
    $cont->setWidths('small-up-7');
    foreach ($this as $day) {
      $cont->append($day);
    }
    return $cont;
  }

  public function getIterator(): \Traversable {
    return new \ArrayIterator($this->days);
  }

  protected function createHead(): BlockGrid {
    $row = new BlockGrid();
    $row->setWidths('small-up-7');
    $row->addCssClass('head', 'weekday-names');
    $cu = new CalendarUtils();
    foreach ($cu->getWeekdays() as $num => $day) {
      $div = Tags::div();
      $div->addCssClass('name', strtolower($day));
      $div->append('<span class="show-for-small-only">' . $cu->getWeekdayName($num, 2) . '</span>');
      $div->append('<span class="hide-for-small-only">' . $day . '</span>');
      $row->append($div);
    }
    return $row;
  }

  public function contentToString(): string {
    return $this->createHead() . $this->parseMonth()->getHtml() . $this->popup;
  }

}
