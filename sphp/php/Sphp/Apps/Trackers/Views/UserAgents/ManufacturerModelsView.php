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
use Sphp\Html\Sections\Aside;
use Sphp\Foundation\Sites\Containers\Popup;
use Sphp\Apps\Trackers\Data\UserAgents\UserAgentModel;

/**
 * Class ManufacturerModelsView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ManufacturerModelsView extends AbstractShareView {

  /**
   * @var Popup
   */
  private $popup;

  public function __construct() {
    $this->popup = new Popup('<div class="content"></div>');
    $this->popup->setAttribute('id', 'browsers');
    parent::__construct();
  }

  public function __destruct() {
    unset($this->popup);
    parent::__destruct();
  }

  public function getPopup(): Popup {
    return $this->popup;
  }

  public function buildRow(int $rowNumber, ShareData $data): Aside {
    $aside = parent::buildRow($rowNumber, $data);
    return $this->insertPopupFunctionality($aside, $data);
  }

  protected function insertPopupFunctionality(Aside $target, UserAgentModel $uaModel): Aside {
    if ($uaModel->getVersionCount() > 1) {
      $this->popup->createController($target);
      $target->addCssClass('has-multiple-versions');
      $url = '/app/stats-app/ajax/ua.php?products=' . $uaModel->getName();
      $target->setAttribute('data-url', $url);
    }
    return $target;
  }

  protected function parseModel(UserAgentModel $param): string {
    $out = $this->parseStringValue($param->getName());
    return $out;
  }

  public function buildHeading(): string {
    $dataCollection = $this->getData();
    if (count($dataCollection) > 0) {
      $data = $dataCollection[0];
      $out = '<small>All</small> ' . $this->parseStringValue($data->getMaker()) . '<small> products</small>';
    } else {
      $out = 'No Useragent data available';
    }
    return $out;
  }

  public function buildNameField(ShareData $data): string {
    if ($data instanceof UserAgentModel) {
      $out = (string) $data->getName() . ' <small>(' . $data->getVersionCount() . ' versions)</small>';
    } else {
      $out = (string) $data->getName();
    }
    return $out;
  }

  public function getDescriptionHeadings(): string {
    return 'model:';
  }

}
