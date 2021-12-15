<?php

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Trackers\Views\Date;

use Sphp\Html\Component;
use Sphp\Html\AbstractContent;
use Sphp\DateTime\Date;
use Sphp\DateTime\ImmutableDate;
use Sphp\DateTime\Periods;
use Sphp\Html\Navigation\A;
use Sphp\Html\Media\Icons\FontAwesomeIcon;
use Sphp\Html\Forms\Buttons\Button;
use Sphp\Html\Forms\Form;
use Sphp\Html\Forms\ContainerForm;
use Sphp\Html\Forms\Buttons\Submitter;
use Sphp\Html\Forms\Inputs\Menus\MenuFactory;
use Sphp\Foundation\Sites\Forms\FormRow;
use Sphp\Html\Forms\Inputs\Menus\Select;
use Sphp\Foundation\Sites\Forms\Inputs\SwitchBoard;
use Sphp\Foundation\Sites\Containers\Dropdown;
use Sphp\Html\Div;
use Sphp\Html\Forms\Inputs\NumberInput;
use Sphp\Network\QueryString;
use Sphp\Foundation\Sites\Navigation\BreadCrumbs;

/**
 * Implements a MonthSelector for calendar
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class MonthSelector extends AbstractContent {

  /**
   * @var ImmutableDate
   */
  private $date;
  private $domains;
  private $currentDomains;

  /**
   * Constructor
   * 
   * @param array $domains
   */
  public function __construct(array $domains = []) {
    $this->setDomains($domains);
    $this->date = new ImmutableDate();
  }

  public function __destruct() {
    unset($this->date);
  }

  public function getDomains(): array {
    return $this->domains;
  }

  public function getSelectedDomains(): array {
    return $this->currentDomains;
  }

  public function getCurrentYear(): int {
    return $this->date->getYear();
  }

  public function getCurrentMonth(): int {
    return $this->date->getMonth();
  }

  public function setDomains(array $domains) {
    $this->domains = $domains;
    return $this;
  }

  public function setCurrentDomain(array $currentDomain = []) {
    $this->currentDomains = $currentDomain;
    return $this;
  }

  public function setCurrentMonth(int $month, int $year) {
    $this->date = ImmutableDate::mkDate(1, $month, $year);
    return $this;
  }

  public function createDomainSelector(): ?SwitchBoard {
    $selector = null;
    if ($this->getDomains() > 1) {
      $selector = new SwitchBoard();
      $selector->setDescription('Select domains');
      $selector->setToggler('All domains', 'all_domains');
      foreach ($this->getDomains() as $domain) {
        $switch = $selector->appendNewSwitch($domain, 'domain[]', $domain);
        $switch->setChecked(in_array($domain, $this->currentDomains));
        var_dump(in_array($domain, $this->currentDomains));
      }
        var_dump(in_array($domain, $this->currentDomains));
      //$selector->setInitialState($this->currentDomain);
    }
    return $selector;
  }

  public function buildUrl(int $month = null, int $year = null, array $domain = null): string {
    $query = new QueryString();
    if ($month === null) {
      $month = $this->getCurrentMonth();
    }
    $query->set('month', $month);
    if ($year === null) {
      $year = $this->getCurrentYear();
    }
    $query->set('year', $year);
    if ($domain === null) {
      $query->set('domain', $this->getSelectedDomains());
    }
    return '/stats/calendar/?' . $query;
  }

  public function createPreviousMonth(): A {
    $prev = $this->date->jumpMonths(-1);
    $monthText = "Go to {$prev->format('F Y')}";
    $content = new FontAwesomeIcon('fas fa-chevron-left', $monthText);
    $content->setSize('lg');
    $link = $this->createMonthLink($prev, $content);
    $link->addCssClass('jump-one');
    return $link;
  }

  public function createNextMonth(): A {
    $next = $this->date->jumpMonths(1);
    $monthText = "Go to {$next->format('F Y')}";
    $content = new FontAwesomeIcon('fas fa-chevron-right', $monthText);
    $content->setSize('lg');
    $link = $this->createMonthLink($next, $content);
    $link->addCssClass('forward');
    return $link;
  }

  public function createMonthLink(Date $month, $content = null): A {
    $href = $this->buildUrl($month->getMonth(), $month->getYear());
    $basicText = $month->format('F Y');
    if ($content === null) {
      $content = $basicText;
    }
    $link = new A($href, $content);
    if ($month->isCurrentMonth()) {
      $link->addCssClass('current-month');
    }
    if ($month->format('Y-m') === $this->date->format('Y-m')) {
      $link->addCssClass('active');
    }
    return $link;
  }

  public function buildContent(): Component {
    $naw = new BreadCrumbs();
    $now = new ImmutableDate();
    $hasNow = false;
    $naw->addCssClass('month-nav', 'at');
    $first = $this->date->jumpMonths(-1);
    $period = Periods::months($first, 2);
    $naw->append($this->createPreviousMonth());
    if ($now->compareTo($first) < 0) {
      $naw->append($this->createMonthLink($now, $now->format('M Y')));
      $hasNow = true;
    }
    foreach ($period as $month) {
      if ($month->format('Y-m') === $this->date->format('Y-m')) {
        $naw->appendCurrent('<span class="active">' . $month->format('M Y') . '</span>');
      } else {
        $naw->append($this->createMonthLink($month, $month->format('M Y')));
      }
      if ($now->format('Y-m') === $month->format('Y-m')) {
        $hasNow = true;
      }
    }
    if (!$hasNow) {
      $naw->append($this->createMonthLink($now, $now->format('M Y')));
    }
    $naw->append($this->createNextMonth());
    $naw->append($this->buildDroppdowm());
    return $naw;
  }

  public function buildMonthMenu(): Select {
    $menu = MenuFactory::months('month')->setInitialValue($this->getCurrentMonth());
    return $menu;
  }

  public function buildYearMenu(): NumberInput {
    $menu = new NumberInput('year');
    $menu->setInitialValue($this->getCurrentYear());
    $menu->setPlaceholder('year');
    $menu->setRange(0, (int) date('Y'));
    return $menu;
  }

  protected function buildForm(): Form {
    $container = new ContainerForm('/stats/calendar', 'get');
    $container->addCssClass('calendar-settings');
    $row = new FormRow();
    // $row->setLayouts('padding-x');
    $row->appendCell($this->buildMonthMenu())->auto();
    $row->appendCell($this->buildYearMenu())->shrink();
    $container->append($row);

    $container->append($this->createDomainSelector());
    $container->append(new Submitter('Go!'));
    return $container;
  }

  protected function buildDroppdowm(): Dropdown {
    $div = new Div;
    $div->addCssClass('calendar-selection');
    $content = new FontAwesomeIcon('fas fa-sliders-h', 'Settings');
    $trigger = new Button($content . ' settings');
    $trigger->addCssClass('selection-trigger');
    $dropdown = new Dropdown($trigger, $div);
    $div->append($this->buildForm());
    // print_r($this);
    $dropdown->setSize('large');
    $dropdown->closeOnBodyClick(true);
    return $dropdown;
  }

  public function getHtml(): string {
    return $this->buildContent();
  }

}
