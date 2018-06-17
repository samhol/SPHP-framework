<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\DateTime\Calendars;

use Sphp\Html\Content;
use Sphp\Html\Div;
use Sphp\DateTime\Date;
use Sphp\Html\Span;
use Sphp\Html\Navigation\Hyperlink;
use Sphp\Html\Media\Icons\FaIcon;
use Sphp\Html\Adapters\QtipAdapter;

/**
 * Description of WeekDay
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class MonthSelector implements Content {

  use \Sphp\Html\ContentTrait;

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
    $prev = $this->date->jumpMonths(-1);
    $monthText = "Go to {$prev->format('F Y')}";
    $content = new FaIcon('fas fa-chevron-left', $monthText);
    $content->setSize('sm');
    $link = $this->createMonthLink($prev, $content);
    $link->addCssClass('prev-month');
    return $link;
  }

  public function createNextMonth(): Hyperlink {
    $prev = $this->date->jumpMonths(1);
    $monthText = "Go to {$prev->format('F Y')}";
    $content = new FaIcon('fas fa-chevron-right', $monthText);
    $content->setSize('sm');
    $link = $this->createMonthLink($prev, $content);
    $link->addCssClass('next-month');
    return $link;
  }

  public function createMonthLink(Date $month, $content = null): Hyperlink {
    $monthText = "Go to {$month->format('F Y')}";
    $href = "calendar/" . $month->getYear() . "/" . $month->getMonth();
    if ($content === null) {
      $content = $monthText;
    }
    $link = new Hyperlink($href, $content);
    $qtip = new QtipAdapter($link);
    $qtip->setQtipPosition('top center', 'bottom center')->setQtip($monthText);
    return $link;
  }

  protected function buildDate(): Div {
    $container = new Div();
    $container->attributes()->classes()->protect('sphp', 'month-selector');
    $container->append($this->createPreviousMonth());
    $container->append(new Span($this->date->format('F Y')));
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
