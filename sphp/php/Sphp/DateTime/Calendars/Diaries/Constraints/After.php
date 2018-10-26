<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries\Constraints;

use Sphp\DateTime\DateInterface;
use Sphp\DateTime\Date;

/**
 * Implements a constraint including all Calendar Dates after the limit
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class After implements DateConstraint {

  /**
   * @var Date 
   */
  private $limit;

  /**
   * Constructor
   * 
   * @param DateInterface $limit the date of the holiday
   */
  public function __construct($limit) {
    if (!$limit instanceof DateInterface) {
      $limit = new Date($limit);
    }
    $this->limit = $limit;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->limit);
  }

  /**
   * Returns the limit date
   * 
   * @return DateInterface the limit
   */
  public function getDate(): DateInterface {
    return $this->limit;
  }

  public function isValidDate($date): bool {
    return $this->limit->isEarlierThan($date);
  }

}
