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

use Sphp\Apps\Trackers\Views\AbstractShareView;
use Sphp\Apps\Trackers\Data\ShareData;
use Sphp\Html\Layout\Section;
use Sphp\Html\Layout\Aside;
use Sphp\Foundation\Sites\Containers\Popup;
use Sphp\Foundation\Sites\Navigation\BreadCrumbs;

/**
 * Class BasicShareView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class BasicShareView extends AbstractShareView {

  private $heading;

  /**
   * @var Popup
   */
  private $popup;

  public function __construct(string $heading = null) {
    $this->popup = new Popup('<div class="content"></div>');
    //$this->popup->setId('browsers');
    $this->heading = $heading;
    parent::__construct();
  }

  public function __destruct() {
    unset($this->popup);
    parent::__destruct();
  }

  public function buildBreadGrumbs(): BreadCrumbs {
    $breadGrumbs = new BreadCrumbs();
    $breadGrumbs->appendLink('/', '<span class="icon"><i class="fas fa-home"></i></span> Home');
    $breadGrumbs->appendLink('/stats', 'Statistics');
    $breadGrumbs->appendLink('/stats/ua/all', 'User Agents');
    return $breadGrumbs;
  }

  public function getPopup(): Popup {
    return $this->popup;
  }

  public function buildContent(): Section {
    $section = parent::buildContent();
    $section->append($this->popup);
    return $section;
  }

  public function buildRow(int $rowNumber, ShareData $userAgentData): Aside {
    $aside = parent::buildRow($rowNumber, $userAgentData);
    //if ($userAgentData->getVersionCount() > 1) {
    $this->popup->createController($aside);
    $aside->addCssClass('has-multiple-versions');
    if ($userAgentData->isCrawler()) {
      $url = '/app/stats-app/ajax/ua.php?crawler=' . $userAgentData->getName();
    } else {
      $url = '/app/stats-app/ajax/ua.php?browser=' . $userAgentData->getName();
    }
    $aside->setAttribute('data-traffic-stats-url', $url);
    //}
    return $aside;
  }

  public function buildNameField(ShareData $data): string {
    $div = new \Sphp\Html\Div();
    $div->addCssClass('description-field');
    $out = $data->getModel();
    if ($data->getMaker() !== null) {
      $out .= ' <small> by ' . $data->getMaker() . '</small>';
    }
    // $out .= ' <small> ,' . $data->getVersionCount() . ' versions</small>';
    $out .= ' <div class="info"><i class="fas fa-info-circle"></i> <small>information</small></div>';
    $div->append($out);
    return $div->getHtml();
  }

  public function getDescriptionHeadings(): string {
    return 'model:';
  }

}
