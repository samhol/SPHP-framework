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

use Sphp\DateTime\DateTime;
use Sphp\DateTime\ImmutableDateTime;

/**
 * Class DomainUsersStats
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
abstract class AbstractURLStatistics {

  /**
   * @var DateTime 
   */
  protected $firstVisit;

  /**
   * @var DateTime 
   */
  protected $lastVisit;

  /**
   * @var int
   */
  protected $userCount;

  /**
   * @var int
   */
  protected $clickCount;

  /**
   * @var int
   */
  protected $domainCount;

  /**
   * @var int
   */
  protected $pathCount;

  /**
   * @var int
   */
  protected $visitCount;

  public function __construct() {
    settype($this->userCount, 'integer');
    settype($this->clickCount, 'integer');
    settype($this->pathCount, 'integer');
    settype($this->domainCount, 'integer');
    settype($this->visitCount, 'integer');
    $this->firstVisit = new ImmutableDateTime($this->firstVisit);
    $this->lastVisit = new ImmutableDateTime($this->lastVisit);
  }

  public function __destruct() {
    unset($this->firstVisit, $this->lastVisit);
  }

  public function getFirstVisit(): DateTime {
    return $this->firstVisit;
  }

  public function getLastVisit(): DateTime {
    return $this->lastVisit;
  }

  public function getUserCount(): int {
    return $this->userCount;
  }

  public function getVisitCount(): int {
    return $this->visitCount;
  }

  public function getClickCount(): int {
    return $this->clickCount;
  }

  public function getPathCount(): int {
    return $this->pathCount;
  }

  public function getDomainCount(): int {
    return $this->domainCount;
  }

  public function contaisPaths(): bool {
    return $this->getPathCount() > 0;
  }

  public function toArray(): array {
    $vars = get_object_vars($this);
    //print_r($vars);
    $vars['firstVisit'] = $this->getFirstVisit()->format('Y-m-d H:i:s T');
    $vars['lastVisit'] = $this->getLastVisit()->format('Y-m-d H:i:s T');
    return $vars;
  }

}
