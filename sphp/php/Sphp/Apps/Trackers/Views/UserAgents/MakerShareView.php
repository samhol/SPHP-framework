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

/**
 * Class MakerShareView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class MakerShareView extends AbstractShareView {

  /**
   * @var Popup
   */
  private $popup;

  public function __construct() {
    $this->popup = new Popup('<div class="content"></div>');
   // $this->popup->setAttribute('id', 'browsers');
    parent::__construct();
  }

  public function __destruct() {
    unset($this->popup);
    parent::__destruct();
  }

  public function getPopup(): Popup {
    return $this->popup;
  }

  public function buildContent(): Section {
    $section = parent::buildContent();
   // $section->prepend(Tags::h2($this->buildHeading()));
    $section->append($this->getPopup());
    return $section;
  }

  public function buildRow(int $rowNumber, ShareData $data): Aside {
    $aside = parent::buildRow($rowNumber, $data);
    if ($data->getVersionCount() > 1) {
      $this->getPopup()->createController($aside);
      $aside->addCssClass('has-multiple-versions');
      $url = '/app/stats-app/ajax/ua.php?products=' . $data->getMaker();
      $aside->setAttribute('data-traffic-stats-url', $url);
    }
    return $aside;
  }

  protected function parseNameData(\stdClass $data): string {

    $out = $this->parseStringValue($data->name);

    return (string) $out;
  }

  public function buildHeading(): string {
    $dataCollection = $this->getData();
    if (count($dataCollection) > 0) {
      $out = 'Manufacturer statistics';
    } else {
      $out = 'No Manufacturer data available';
    }
    return $out;
  }

  public function buildNameField(ShareData $data): string {
    if ($data->getMaker() === null || $data->getMaker() === '') {
      $out = 'Unrecognizable manufacturers';
    } else {
      $out = $this->parseStringValue($data->getMaker());
      if ($data->getVersionCount() > 1) {
        $out .= ' <span><i class="fas fa-info-circle"></i></span>';
      }
    }
    return $out;
  }

  public function getDescriptionHeadings(): string {
    return 'Manufacturer:';
  }

}
