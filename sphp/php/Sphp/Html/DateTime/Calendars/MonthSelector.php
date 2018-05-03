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
use Sphp\Html\CssClassifiableContent;
use Sphp\Html\Attributes\ClassAttribute;

/**
 * Description of WeekDay
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class MonthSelector implements Content, CssClassifiableContent {

  use \Sphp\Html\ContentTrait,
      \Sphp\Html\CssClassifiableTrait;

  /**
   * @var Date
   */
  private $date;

  /**
   * @var Div
   */
  private $container;

  public function __construct(int $year = null, int $month = null) {
    if ($year === null) {
      $year = (int) date('Y', time());
    }
    if ($month === null) {
      $month = (int) date('m', time());
    }
    $this->month = $month;
    $this->year = $year;
    $this->date = Date::from("$year-$month-1");
    $this->container = new Div();
    $this->container->attributes()->classes()->protect('sphp', 'month-selector');
  }

  public function cssClasses(): ClassAttribute {
    return $this->container->cssClasses();
  }

  protected function buildDate() {
    $this->container->append($this->date->format('F Y'));
    return $this;
  }

  public function getHtml(): string {
    $this->buildDate();
    return $this->container->getHtml();
  }

}
