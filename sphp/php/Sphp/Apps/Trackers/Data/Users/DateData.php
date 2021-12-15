<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Trackers\Data\Users;

use Sphp\DateTime\ImmutableDate;
use Sphp\DateTime\Date;

/**
 * Class DateTata
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DateData {

  /**
   * @var ImmutableDate
   */
  private $date;

  /**
   * @var int
   */
  private $visits;

  /**
   * @var int
   */
  private $firstVisits;

  /**
   * @var int
   */
  private $clicks;

  /**
   * @var int
   */
  private $crawlers;
 

  public function __construct() {
    settype($this->visits, 'integer');
    settype($this->firstVisits, 'integer');
    settype($this->clicks, 'integer');
    settype($this->crawlers, 'integer');
  }

  public function __destruct() {
    unset($this->date);
  }

  public function getDate(): Date {
    if (!$this->date instanceof Date) {
      $this->date = new ImmutableDate($this->date);
    }
    return $this->date;
  }

  public function setDate(Date $date) {
    $this->date = $date;
    return $this;
  }

  public function getVisits(): int {
    return $this->visits;
  }

  public function getFirstVisits(): int {
    return $this->firstVisits;
  }

  public function getRefreshes(): int {
    return $this->clicks;
  }

  public function getCrawlers(): int {
    return $this->crawlers;
  }

}
