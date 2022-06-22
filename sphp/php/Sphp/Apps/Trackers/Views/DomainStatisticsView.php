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
use Sphp\Apps\Trackers\Data\URLs\DomainStatistics;
use Sphp\Html\Layout\Section;
use Sphp\Foundation\Sites\Containers\Popup;
use Sphp\Html\Forms\Buttons\PushButton;

/**
 * Class DomainStatisticsView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DomainStatisticsView extends AbstractContent {

  /**
   * @var DomainStatistics 
   */
  private $domain;

  /**
   * @var Popup
   */
  private $popup;

  public function __construct(DomainStatistics $domain, string $heading = null) {
    $this->domain = $domain;
    $this->popup = new Popup('<div class="content"></div>');
    $this->popup->setAttribute('id', 'urls');
    $this->heading = $heading;
  }

  public function __destruct() {
    unset($this->domain);
  }

  public function buildDomainData(): Section {
    $section = new Section();
    $section->addCssClass('traffic-statistics');
    $section->appendH3($this->domain->getDomainName());
    $div = new \Sphp\Html\Div();
    $div->addCssClass('block');
    $section->append($div);
    $div->append(Factory::paintDate('Since', $this->domain->getFirstVisit()));
    $div->append(Factory::paintAll('Users', $this->domain->getUserCount(), $this->domain->getUserShare()));
    $div->append(Factory::paintTotal('Sites', $this->domain->getPathCount()));
    $div->append(Factory::paintAll('Visits', $this->domain->getVisitCount(), $this->domain->getVisitShare()));
    $div->append(Factory::paintAll('Clicks', $this->domain->getClickCount(), $this->domain->getClickShare()));
    $div->append(Factory::paintDateTime('Visited', $this->domain->getLastVisit()));
    $section->append($this->builDomaindModals());
    return $section;
  }

  public function builDomaindModals(): string {
    $domain = $this->domain->getDomainName();
    $out = '';
    $group = new \Sphp\Html\Div();
    $group->addCssClass('btn-group');
    if ($this->domain->contaisPaths()) {
      $okUrls = (new PushButton('<i class="fas fa-chart-pie fa-fw"></i> Path statistics'))->addCssClass('modal-trigger');
      $okUrls->setAttribute('data-traffic-stats-url', '/app/stats-app/ajax/urls.php?domain=' . $domain);
      $this->popup->createController($okUrls);
      $group->append($okUrls);
    }
    $out .= $group . $this->popup;
    return $out;
  }

  public function getHtml(): string {
    return $this->buildDomainData()->getHtml();
  }

}
