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
 * Class UserAgentShareData
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class UserAgentShareData implements ShareData {

  /**
   * @var string
   */
  private $raw;

  /**
   * @var float
   */
  private $share;

  public function __construct() {
    settype($this->raw, 'string');
    settype($this->share, 'float');
  }

  public function getShare(): float {
    return $this->share;
  }

  public function getUserAgent(): UserAgent {
    return UserAgentParser::instance()->fromRawString($this->raw);
  }

}
