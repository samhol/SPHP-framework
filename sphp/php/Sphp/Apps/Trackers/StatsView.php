<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Trackers;

use Sphp\Config\Config;
use Sphp\Apps\Trackers\Views\StatisticsView;
use Sphp\Html\Layout\Section;
use Sphp\Html\Content;
use Sphp\Foundation\Sites\Navigation\BreadCrumbs;

/**
 * Class Stats
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class StatsView {

  /**
   * @var Content
   */
  private $errorView;

  public function getErrorView(): ?Content {
    return $this->errorView;
  }

  public function setErrorView(Content $errorView) {
    $this->errorView = $errorView;
    return $this;
  }

  public function run(string $task = null): string {
    $out = new Section;
    $out->addCssClass('statistics');
    $out->appendH1('Network Traffic statistics');
    if (str_starts_with((string) $task, 'calendar')) {
      $uaView = Config::instance()->dice->create(ViewCalendar::class);
      $uaView->setErrorView(new \ATC\MVC\ErrorPageView());
      $out = $uaView->run($task);
    }else if (str_starts_with((string) $task, 'ua')) {
      $uaView = Config::instance()->dice->create(Views\UserAgents\UAView::class);
      //$uaView->setErrorView(new \ATC\MVC\ErrorPageView());
      $out = $uaView->run($task);
    }else if ($task === null) {
      //$out->appendH1('Site Statistics');
      //$out->append($this->buildBreadGrumbs());
      $out->append($this->basicView());
    } else {
      $out->append($this->errorView);
    }
   // $out->append(new \Sphp\Html\Scripts\ScriptSrc('/app/stats-app/javascripts/ajax.js'));
    return $out->getHtml();
  }
  
  public function runCalendar($param) {
    
  }

  public function basicView() {
    $generalInfoView = Config::instance()->dice->create(StatisticsView::class);
    return $generalInfoView;
  }

  protected function buildBreadGrumbs(): BreadCrumbs {
   // $bc = NaviViews::fromYamlFile('./linkit/breadcrumbs.yml');
    return $bc->build();
  }

}
