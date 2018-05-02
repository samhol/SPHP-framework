<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Events\Constraints;

use Sphp\DateTime\Date;
use Sphp\DateTime\DateInterface;

/**
 * Implements a group constraint
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class OneOf implements DateConstraint {

  /**
   * @var Date[]
   */
  private $dates;

  /**
   * Constructor
   * 
   * @param  DateInterface|DateTimeInteface|string|int ...$date
   */
  public function __construct(... $date) {

    $this->dates = [];
    foreach ($date as $d) {
      $this->addDate($d);
    }
  }

  /**
   * Adds new allowed dates
   * 
   * @param  DateInterface|DateTimeInteface|string|int ...$date
   * @return $this
   */
  public function addDates(... $date) {
    foreach ($date as $d) {
      $this->addDate($d);
    }
    return $this;
  }

  /**
   * 
   * @param  DateInterface|DateTimeInteface|string|int $date
   * @return $this
   */
  public function addDate($date) {
    if (!$date instanceof DateInterface && !$date instanceof \DateTimeInterface) {
      $date = new Date($date);
    }
    $key = $date->format('Y-m-d');
    if (!array_key_exists($key, $this->dates)) {
      $this->dates[$key] = $date;
    }
    return $this;
  }

  public function isValidDate($date): bool {
    if (!$date instanceof DateInterface) {
      $date = new Date($date);
    }
    $key = $date->format('Y-m-d');
    return array_key_exists($key, $this->dates);
  }

}
