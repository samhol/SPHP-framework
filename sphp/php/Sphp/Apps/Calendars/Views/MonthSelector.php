<?php

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Calendars\Views;

use Sphp\Html\AbstractContent;
use Sphp\Bootstrap\Components\ToolBar;
use Sphp\DateTime\ImmutableDate;
use Sphp\DateTime\Date;
use Sphp\Html\Navigation\A;
use Sphp\Html\Media\Icons\FontAwesomeIcon;
use Sphp\Html\Adapters\TipsoAdapter;
use Sphp\Apps\Calendars\DateUtils;
use Sphp\Html\Forms\Inputs\Menus\Select;
use Sphp\Bootstrap\Components\Forms\InputGroup;
use Sphp\Html\Forms\Inputs\NumberInput;

/**
 * Description of WeekDay
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class MonthSelector extends AbstractContent {

  private Date $date;

  /**
   * Constructor
   * 
   * @param int $year
   * @param int $month
   */
  public function __construct(int $year, int $month) {
    $this->date = ImmutableDate::from("$year-$month-1");
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->date);
  }

  public function createPreviousMonth(): A {
    $prev = $this->date->jumpMonths(-1);
    $monthText = "Go to {$prev->format('F Y')}";
    $content = new FontAwesomeIcon('fas fa-chevron-left', $monthText);
    $content->setSize('sm');
    $link = $this->createMonthLink($prev, $content);
    $link->addCssClass('prev-month');
    return $link;
  }

  public function createNextMonth(): A {
    $prev = $this->date->jumpMonths(1);
    $monthText = "Go to {$prev->format('F Y')}";
    $content = new FontAwesomeIcon('fas fa-chevron-right', $monthText);
    $content->setSize('sm');
    $link = $this->createMonthLink($prev, $content);
    $link->addCssClass('next-month');
    return $link;
  }

  public function createMenus(): InputGroup {
    $group = new InputGroup();
    $group->addCssClass("mx-2");
    $group->appendInput($this->createYearMenu());

    $group->appendInput($this->createMonthMenu());
    $group->appendButton((new \Sphp\Html\Forms\Buttons\Button('view'))->addCssClass('btn-success'));
    return $group;
  }

  public function createMonthLink(ImmutableDate $month, $content = null): A {
    $monthText = "Go to {$month->format('F Y')}";
    $href = "/calendar/" . $month->getYear() . "/" . $month->getMonth();
    if ($content === null) {
      $content = $monthText;
    }
    $link = new A($href, $content);
    $link->setRelationship('nofollow');
    $tip = new TipsoAdapter($link);
    $tip->setOption('titleContent', $monthText);
    return $link;
  }

  public function createMonthMenu(): Select {
    $dateUtils = new DateUtils();
    $monthMenu = new Select('month');
    foreach ($dateUtils->getMonths() as $monthNumber => $monthName) {
      $opt = $monthMenu->appendOption($monthNumber, $monthName);
      if ($this->date->getMonth() === $monthNumber) {
        $opt->setSelected(true);
      }
    }
    return $monthMenu;
  }

  public function createYearMenu(): NumberInput {
    $yInput = new NumberInput('year', $this->date->getYear());
    $yInput->setRange(1900, 2100);
    $yInput->setPlaceholder('year');
    return $yInput;
  }

  protected function buildDate(): string {
    $toolBar = new ToolBar('Month selector for calendar');
    $toolBar->append($this->createPreviousMonth());
    $toolBar->addCssClass('month-selector');
    $toolBar->appendInputGroup($this->createMenus());
    $toolBar->append($this->createNextMonth());
    return $toolBar->getHtml();
  }

  public function getHtml(): string {
    return $this->buildDate();
  }
 

}
