<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Trackers\Data\URLs;

use Sphp\Stdlib\Datastructures\Arrayable;

/**
 * Class DomainUsersStats
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DomainStatistics extends AbstractURLStatistics implements Arrayable {

  /**
   * @var string 
   */
  private $domain;

  /**
   * @var float
   */
  protected $userShare;

  /**
   * @var float
   */
  protected $clickShare;

  /**
   * @var float
   */
  protected $visitShare;

  /**
   * Constructor
   * 
   * @param string $domainName
   */
  public function __construct(string $domainName = null) {
    if ($domainName !== null) {
      $this->domain = $domainName;
    }
    settype($this->domain, 'string');
    settype($this->userShare, 'float');
    settype($this->clickShare, 'float');
    settype($this->visitShare, 'float');
    parent::__construct();
  }

  public function getDomainName(): string {
    return $this->domain;
  }

  public function getUserShare(): float {
    return $this->userShare;
  }

  public function getClickShare(): float {
    return $this->clickShare;
  }

  public function getVisitShare(): float {
    return $this->visitShare;
  }

}
