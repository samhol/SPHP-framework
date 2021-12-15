<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Calendars\Views;

use Sphp\Html\AbstractContent;
use Sphp\DateTime\Periods;
use Sphp\I18n\Datetime\CalendarUtils;
use Sphp\Html\Lists\Ul;
use Sphp\Html\Lists\Ol;
use Sphp\Html\Sections\Headings\Header;
use Sphp\Html\Div;
use Sphp\Bootstrap\Components\Modal;
use Sphp\DateTime\ImmutableDate;

/**
 * Class MonthView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class MonthView extends AbstractContent {

  private int $year;
  private int $month;
  private Modal $modal;

  /**
   * Constructor
   * 
   * @param int $year
   * @param int $month
   */
  public function __construct(int $year, int $month) {
    $this->year = $year;
    $this->month = $month;
    $this->modal = new Modal;
    $this->modal
            ->setVerticallyCentered()
            ->setScrollable()
            ->setSize('lg')
            ->setFullScreen('md-down');
    $this->modal->getFooter()->append('<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>');
  }

  public function __destruct() {
    unset($this->modal);
  }

  public function useDiary($param) {
    $this->diary = $param;
  }

  public function parseDays() {
    $container = new Div();
    $container->addCssClass('calendar-app');
    $container->append($this->createHead());
    $container->append(new Modal());
    $container->append(new MonthSelector($this->year, $this->month));
    $container->append($this->createWeekdays());
    $list = new Ol;
    $list->addCssClass('day-grid');
    $container->append($list);
    foreach (Periods::weeksOfMonth($this->getMonth(), $this->getYear(), 'P1D') as $day) {
      $dayNumBlock = new Div($day->format('j'));
      $dayNumBlock->addCssClass('date');
      // $dayBlock = $list->append($dayNumBlock)->addCssClass(strtolower($day->format('l')));
      $dayBlock = $list->append(new DayCell($this->diary->getDate($day)));
      $dayBlock->addCssClass('date-cell', strtolower($day->format('l')));
      $dayBlock->setAttribute('data-date', $day->format('Y-m-d'));
      if ($day->isCurrentDate()) {
        $dayBlock->addCssClass('today');
      }
      if ($day->getMonth() === $this->month) {
        $dayBlock->addCssClass('current-month');
      } else {
        $dayBlock->addCssClass('not-current-month');
      }
      $this->modal->initTrigger($dayBlock);
    }
    return $container;
  }

  public function getYear(): int {
    return $this->year;
  }

  public function getMonth(): int {
    return $this->month;
  }

  public function getModal(): Modal {
    return $this->modal;
  }

  protected function createHead(): Header {
    $date = ImmutableDate::from("$this->year-$this->month-1");
    $header = new Header();
    $header->appendH2($date->format('F Y'));
    return $header;
  }

  protected function createWeekdays(): Ul {
    $cu = new CalendarUtils();
    $ul = new Ul;
    $ul->addCssClass('weekdays');
    for ($d = 1; $d <= 7; $d++) {
      $day = $cu->getWeekdayName($d);
      $div = new div();
      $div->addCssClass('name', strtolower($day));
      $div->append('<span class="d-block d-md-none">' . $cu->getWeekdayName($d, 2) . '</span>');
      $div->append('<span class="d-none d-md-block">' . $day . '</span>');
      $ul->append($div);
    }
    return $ul;
  }

  public function getHtml(): string {
    return $this->parseDays() . $this->modal;
  }

}
