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
 * Class ManufacturerShareData
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ManufacturerShareData implements ShareData {

  /**
   * @var string
   */
  private $manufacturer;

  /**
   * @var float
   */
  private $share;

  /**
   * @var int
   */
  private $versionCount;

  public function __construct() {
    settype($this->share, 'float');
  }

  public function getMaker(): string {
    return (string) $this->manufacturer;
  }

  public function getShare(): float {
    return $this->share;
  }

  public function getVersionCount(): int {
    return $this->versionCount;
  }

}
