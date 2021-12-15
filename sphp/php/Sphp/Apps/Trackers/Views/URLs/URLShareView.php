<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Trackers\Views\URLs;

use Sphp\Apps\Trackers\Views\AbstractShareView;
use Sphp\Html\Tags;
use Sphp\Apps\Trackers\Data\ShareData;
use Sphp\Network\URL;

/**
 * Class VersionView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class URLShareView extends AbstractShareView {

  public function buildHeading(): string {
    return 'URL statistics';
  }

  public function buildNameField(ShareData $data): string {
    $url = $data->getURL();
    $text = $url->getPath();
    return (string) Tags::a($url->getHtml(), $text);
  }

  public function getDescriptionHeadings(): string {
    return 'path:';
  }

}
