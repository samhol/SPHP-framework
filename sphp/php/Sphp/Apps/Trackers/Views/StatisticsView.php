<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Trackers\Views;

use Sphp\Html\AbstractContent;
use Sphp\Apps\Trackers\Data\DB;
use Sphp\Html\Sections\Section;
use Sphp\Html\Sections\Aside;
use Sphp\Html\Lists\Ul;
use Sphp\Foundation\Sites\Grids\BlockGrid;
use Sphp\Apps\Trackers\Data\URLs\DomainDb;
use Sphp\Html\Tags;

/**
 * Class GeneralInfoView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class StatisticsView extends AbstractContent {

  /**
   * @var DomainDb
   */
  private $domainDb;

  public function __construct(DomainDb $domainDb) {
    $this->domainDb = $domainDb;
  }

  public function __destruct() {
    unset($this->domainDb);
  }

  public function buildTotals(): Aside {
    $aside = new Aside();
    $aside->addCssClass('traffic-statistics');
    $aside->appendH3('Totals');
    $data = $this->domainDb->getTotalStatistics();
    $div = new \Sphp\Html\Div();
    $div->addCssClass('block');
    $aside->append($div);
    $div->append(Factory::paintDate('Since', $data->getFirstVisit()));
    $div->append(Factory::paintTotal('Users', $data->getUserCount()));
    $div->append(Factory::paintTotal('Visits', $data->getVisitCount()));
    $div->append(Factory::paintTotal('Clicks', $data->getClickCount()));
    $div->append(Factory::paintTotal('Paths', $data->getPathCount()));
    $div->append(Factory::paintDateTime('Visited', $data->getLastVisit()));
    return $aside;
  }

  public function getHtml(): string {
    $section = new Section();
    $section->addCssClass('user-statistics');
$section->appendH2('Overview');
    $totals = new BlockGrid('small-up-1', 'medium-up-2', 'grid-margin-x');
    $section->append($totals);
    $totals->append($this->buildTotals());
    $totals->append($this->addtionalInfo());
    //print_r($this->domains);
    if (count($this->domainDb) > 0) {
      $section->appendH2('Sub Domains');
      $blockGrid = new BlockGrid('small-up-1', 'medium-up-2', 'grid-margin-x');
      $section->append($blockGrid);
      foreach ($this->domainDb as $domain) {
        $blockGrid->append(new DomainStatisticsView($domain));
      }
    }
    $section->appendParagraph('<strong>PHP version:</strong> <code>' . PHP_VERSION . '</code> | <strong>MySQL version:</strong> <code>' . $this->domainDb->pdo()->query('select version()')->fetchColumn() . '</code>');
    $section->appendHr();
    //$section->append('<pre>'.var_export($_SESSION, true).'</pre>');
    return $section->getHtml();
  }
  public function builChartModals(): string {
    $domain = $this->domain->getDomainName();
    $out = '';
    $group = new \Sphp\Html\Div();
    $group->addCssClass('btn-group');
    if ($this->domain->contaisPaths()) {
      $okUrls = (new Button('<i class="fas fa-chart-pie fa-fw"></i> Path statistics'))->addCssClass('modal-trigger');
      $okUrls->setAttribute('data-load-url-stats', '/app/stats-app/ajax/urls.php?domain=' . $domain);
      $this->popup->createController($okUrls);
      $group->append($okUrls);
    }
    $out .= $group . $this->popup;
    return $out;
  }

  public function addtionalInfo(): Aside {
    $aside = new Aside();
    $aside->appendH2('User Agent statistics:');
    $nav = new \Sphp\Html\Navigation\Nav;
    $aside->append($nav);
    $ul = new Ul();
    $icon = Tags::span('<i class="fa-fw fas fa-chart-pie"></i>')->addCssClass('icon');
    $ul->appendLink('/stats/ua/browsers', $icon . Tags::span(' browsers')->addCssClass('text'));
    $ul->appendLink('/stats/ua/crawlers', $icon . Tags::span(' crawlers')->addCssClass('text'));
    $ul->appendLink('/stats/ua/makers', $icon . Tags::span(' manufacturers')->addCssClass('text'));
    $nav->append($ul);

    return $aside;
  }

}
