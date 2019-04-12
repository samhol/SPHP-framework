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
use Sphp\Html\Div;
use Sphp\DateTime\Date;
use Sphp\Html\Navigation\Hyperlink;
use Sphp\Html\Media\Icons\FaIcon;
use Sphp\Html\Forms\Inputs\Menus\Option;
use Sphp\Html\Adapters\TipsoAdapter;
use Sphp\Html\Forms\Inputs\Menus\MenuFactory;

/**
 * Description of WeekDay
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class MonthSelector extends AbstractContent {

  /**
   * @var Date
   */
  private $date;

  /**
   * Constructor
   * 
   * @param int $year
   * @param int $month
   */
  public function __construct(int $year = null, int $month = null) {
    if ($year === null) {
      $year = (int) date('Y', time());
    }
    if ($month === null) {
      $month = (int) date('m', time());
    }
    $this->date = Date::from("$year-$month-1");
  }

  public function createPreviousMonth(): Hyperlink {
    $prev = $this->date->modify('-1 month');
    $monthText = "Go to {$prev->format('F Y')}";
    $content = new FaIcon('fas fa-chevron-left', $monthText);
    $content->setSize('sm');
    $link = $this->createMonthLink($prev, $content);
    $link->addCssClass('prev-month');
    return $link;
  }

  public function createNextMonth(): Hyperlink {
    $prev = $this->date->modify('+1 month');
    $monthText = "Go to {$prev->format('F Y')}";
    $content = new FaIcon('fas fa-chevron-right', $monthText);
    $content->setSize('sm');
    $link = $this->createMonthLink($prev, $content);
    $link->addCssClass('next-month');
    return $link;
  }

  public function createMonthLink(Date $month, $content = null): Hyperlink {
    $monthText = "Go to {$month->format('F Y')}";
    $href = "/calendar/" . $month->getYear() . "/" . $month->getMonth();
    if ($content === null) {
      $content = $monthText;
    }
    $link = new Hyperlink($href, $content);
    $tip= new TipsoAdapter($link);
    $tip->setOption('titleContent', $monthText);
    return $link;
  }

  protected function buildDate(): Div {
    $container = new Div();
    $container->attributes()->classes()->protectValue('sphp', 'month-selector');
    $thisYear = (int) date('Y');
    $startYear = $this->date->getYear() - 3;
    $stopYear = $this->date->getYear() + 1;
    $years = range($startYear, $stopYear);
    $yearMenu = MenuFactory::getContentAsValueMenu($years, 'year');
    $yearMenu->setInitialValue($this->date->getYear());
    if (!in_array($thisYear, $years)) {
      $yearMenu->prepend(new Option($thisYear, $thisYear));
    }
    $container->append($this->createPreviousMonth());
    // $container->append( $this->createMonthMenu());
    $container->append($yearMenu);
    $container->append(MenuFactory::months('month')->setInitialValue($this->date->getMonth()));
    // $container->append(new Span($this->date->format('F Y')));
    $container->append($this->createNextMonth());
    return $container;
  }

  public function getHtml(): string {
    return $this->buildDate()->getHtml();
  }

  /**
   * 
   * @param  Date $date
   * @return MonthSelector new instance
   */
  public static function fromDate(Date $date): MonthSelector {
    return new static($date->getYear(), $date->getMonth());
  }

}
