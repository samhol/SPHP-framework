<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Events;

use Sphp\DateTime\DateInterface;
use Sphp\DateTime\Date;

/**
 * Implements a holiday note for a calendar
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class UniqueHoliday extends AbstractHoliday {

  /**
   * @var Date 
   */
  private $date;

  /**
   * Constructor
   * 
   * @param DateInterface $date the date of the holiday
   * @param string $name
   */
  public function __construct(DateInterface $date, string $name) {
    parent::__construct($name);
    $this->date = $date;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->date);
    parent::__destruct();
  }

  /**
   * Returns the date of the holiday
   * 
   * @return Date the date of the holiday
   */
  public function getDate(): Date {
    return $this->date;
  }

  public function dateMatchesWith(DateInterface $date): bool {
    return $this->date->matchesWith($date);
  }

}
