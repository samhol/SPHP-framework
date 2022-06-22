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
use Sphp\Foundation\Sites\Grids\BasicRow;

/**
 * Class VersionView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class VersionView extends AbstractShareView {

  public function buildHeading(): string {
    $dataCollection = $this->getData();
    if (count($dataCollection) > 0) {
      $data = $dataCollection[0];
      $out = $data->getModel();
      if ($data->getMaker() !== null) {
        $out .= ' <small>by ' . $data->getMaker() . '</small>';
      }
      return $out;
    } else {
      $out = 'No version data available';
    }
    return $out;
  }

  protected function parseVersion(\stdClass $data) {
    if ($data->version === null || $data->version === '' || $data->version === '0') {
      $out = '??';
    } else {
      $out = (string) $data->version;
    }
    return $out;
  }

  public function buildNameField(ShareData $data): string {
    $out = $data->getModel();
    if ($data->getVersion() !== '0.0') {
      $out .= ' ' . $data->getVersion();
    }
    return $out;
  }

  public function getDescriptionHeadings(): string {
    return 'model:';
  }

}
