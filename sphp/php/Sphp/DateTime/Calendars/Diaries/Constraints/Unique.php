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
 * Description of Unique
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Unique implements DateConstraint {

  /**
   * @var Date 
   */
  private $date;

  /**
   * Constructor
   * 
   * @param DateInterface $date the date of the holiday
   */
  public function __construct($date) {
    if (!$date instanceof DateInterface) {
      $date = new Date($date);
    }
    $this->date = $date;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->date);
  }

  /**
   * Returns the valid date
   * 
   * @return DateInterface the date of the holiday
   */
  public function getDate(): DateInterface {
    return $this->date;
  }

  public function isValidDate($date): bool {
    return $this->date->equals($date);
  }

}
