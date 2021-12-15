<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Trackers\Data\UserAgents;

use Sphp\Apps\Trackers\Data\ShareData;

/**
 * Class Browser
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class UserAgentModel extends AbstractUserAgent implements ShareData {

  /**
   * @var int
   */
  private $versionCount;

  public function __construct() {
    settype($this->versionCount, 'integer');
    //settype($this->isCrawler, 'bool');
    /* echo '<pre>';
      print_r($this);
      echo '</pre>'; */
    parent::__construct();
  }

  public function getVersionCount(): int {
    return $this->versionCount;
  }

  public function getShare(): float {
    return (float) $this->share;
  }

}
