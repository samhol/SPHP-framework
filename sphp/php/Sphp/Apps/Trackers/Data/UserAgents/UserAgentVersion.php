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
 * Class UserAgentVersion
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class UserAgentVersion extends AbstractUserAgent implements ShareData {

  /**
   * @var string
   */
  private $version;

  /**
   * @var string
   */
  private $raw;

  /**
   * @var float
   */
  private $share;

  public function __construct() {
    settype($this->version, 'string');
    settype($this->share, 'float');
    parent::__construct();
  }
  public function hasVersion(): bool {
    return $this->version;
  }

  public function getVersion(): string {
    return $this->version;
  }

  public function getRaw(): ?string {
    return $this->raw;
  }

  public function getShare(): float {
    return (float) $this->share;
  }

}
