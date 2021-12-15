<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Trackers\Views\UserAgents;

use Sphp\Html\AbstractContent;
use Sphp\Html\Div;
use Sphp\Apps\Trackers\Views\Charts\Doughnut;
use Sphp\Bootstrap\Layout\Container;
/**
 * Class DefaultView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DefaultView extends AbstractContent {

  public function __construct($data) {
    $this->data = $data;
  }

  public function buildContent():Container {
    $cont = new Container();
    $tsp = new Doughnut('/app/stats-app/ajax/json/ua.php?split');
    $row = $cont->appendRow();
    $row->appendColumn($tsp)->small(12)->medium('auto');
    $out = new Div();
    $out->addCssClass('statistics ua ua-groups');
    $out->append($this->buildBrowsersView());
    $row->appendColumn($out)->small(12)->medium('auto');
    return $cont;
  }

  private function buildBrowsersView() {
    $aside = new Div();
    $aside->addCssClass('ua-group');
    $dl = new \Sphp\Html\Lists\Dl();
    $dl->appendTerm('Browsers:');
    $dl->appendDescription('<code>' . round($this->data->browserShare, 2) . '%</code> of all traffic');
    $dl->appendDescription(new \Sphp\Html\Navigation\A('/stats/ua/browsers', 'More information'));
    $dl->appendTerm('Crawlers:');
    $dl->appendDescription('<code>' . round($this->data->crawlerShare, 2) . '%</code> of all traffic');
    $dl->appendDescription(new \Sphp\Html\Navigation\A('/stats/ua/crawlers', 'More information'));
    $dl->appendTerm('User Agent Manufacturers:');
    $dl->appendDescription(new \Sphp\Html\Navigation\A('/stats/ua/makers', 'More information'));
    $aside->append($dl);
    return $aside;
  }

  public function getHtml(): string {
    return $this->buildContent()->getHtml();
  }

}
