<?php declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Trackers\Views\UserAgents;

use Sphp\Html\AbstractContent;
use Sphp\Apps\Trackers\Data\UserAgents\UserAgents;
use Sphp\Html\Layout\Section;
use Sphp\Apps\Trackers\SearchEngine;
use Sphp\Foundation\Sites\Navigation\BreadCrumbs;
use ATC\Views\NaviViews;
use Sphp\Html\Content;

/**
 * Class UAView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class UAView extends AbstractContent {

  /**
   * @var UserAgents 
   */
  private $browsers;

  /**
   * @var Content
   */
  private $errorView;

  public function __construct(UserAgents $uaDb) {
    $this->browsers = $uaDb;
  }

  public function getErrorView(): ?Content {
    return $this->errorView;
  }

  public function setErrorView(Content $errorView) {
    $this->errorView = $errorView;
    return $this;
  }

  public function __destruct() {
    unset($this->browsers);
  }

  public function hasView(string $task): bool {
    $paths = [
        'ua/browsers',
        'ua/crawlers',
        'ua/makers',
        'ua/all',
        'ua/search',
    ];
    return in_array($task, $paths);
  }
  
  protected function buildBreadGrumbs(): BreadCrumbs {
    $bc = NaviViews::fromYamlFile('./linkit/breadcrumbs.yml');
    return $bc->build();
  }

  public function run(string $task): Content {
    $out = new \Sphp\Html\Div;
    $browsers = $this->browsers;
    if ($task === 'ua/browsers') {
      $gen = new BasicShareView();
      $gen->setData($browsers->getUserAgentByName(false));
      $h1 = 'Browser statistics';
      $cont = $gen->getHtml();
    } else if ($task === 'ua/crawlers') {
      $h1 = 'Crawler statistics';
      $gen = new BasicShareView();
      $gen->setData($browsers->getUserAgentByName(true));
      $cont = $gen->getHtml();
    } else if ($task === 'ua/makers') {
      $gen = new MakerShareView();
      $gen->setData($browsers->getManufacturersMarketShare());
      $h1 = $gen->buildHeading();
      $cont = $gen;
    } else if ($task === 'ua/all') {
      $view = new DefaultView($browsers->getTypeSplitData());
      $h1 = 'User Agent Statistics';
      $cont = $view;
    } else if ($task === 'ua/search') {
      $h1 = 'User Agent Search Engine';
      $cont = (new SearchEngine($this->browsers))->run()->getView();
    } else {
      return $this->errorView;
    }
    $out->appendH1($h1);
   // $out->append($this->buildBreadGrumbs());
    $out->append($cont);
    return $out;
  }

  public function getHtml(): string {
    
  }

}
