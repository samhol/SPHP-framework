<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime;

use DatePeriod;
use Sphp\Stdlib\Datastructures\Arrayable;
use Exception;

/**
 * Implements a date period
 *
 * A date period allows iteration over a set of dates and times, recurring at 
 * regular intervals, over a given period.
 * 
 * 
 * @method static Period months(mixed $start, string|DateInterval $length, int $recurrences = 1) Creates a new monthly recurrence instance from input
 * @method \Sphp\DateTime\Period m(mixed $start, string|DateInterval $interval, int $recurrences = 1) Creates a new monthly recurrence instance from input
 * @method \Sphp\DateTime\Period weeks(mixed $start, string|DateInterval $interval, int $recurrences = 1) Creates a new weekly recurrences instance from input
 * @method \Sphp\DateTime\Period w(mixed $start, string|DateInterval $interval, int $recurrences = 1) Creates a new weekly recurrences instance from input
 * @method \Sphp\DateTime\Period days(mixed $start, string|DateInterval $interval, int $recurrences = 1) Creates a new daily recurrences instance from input
 * @method \Sphp\DateTime\Period d(mixed $start, string|\DateInterval $interval, int $recurrences = 1) Creates a new daily recurrences instance from input
 * @method \Sphp\DateTime\Period hours(mixed $start, string|DateInterval $interval, int $recurrences = 1) Creates a new hourly recurrences instance from input
 * @method \Sphp\DateTime\Period h(mixed $start, string|DateInterval $interval, int $recurrences = 1) Creates a new hourly recurrences instance from input
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Period extends DatePeriod implements Arrayable {

  public function constraints() {
    
  }
  /**
   * Checks if the given date is in the range
   * 
   * @param  mixed $date the date to match
   * @return bool true if given datetime is in the period
   */
  public function isInPeriod($date): bool {
    try {
      $dateTime = DateTime::from($date)->getTimestamp();
      $start = $this->getStartDate()->getTimestamp();
      $stop = $this->getEndDate()->getTimestamp();
      return $start <= $dateTime && $dateTime <= $stop;
    } catch (Exception $ex) {
      return false;
    }
  }


  public function dateConstraints(): Constraints {
    return $this->constraint;
  }
  /**
   * Checks if the given date is in the range
   * 
   * @param  mixed $date the date to match
   * @return bool true if given datetime is in the period
   */
  public function contains($date): bool {
    $result = false;
    try {
      $dateTime = DateTime::from($date)->getTimestamp();
      foreach ($this as $d) {
        if ($dateTime === $d->getTimestamp()) {
          $result = true;
          break;
        }
      }
    } catch (Exception $ex) {
      return false;
    }
    return $result;
  }

  /**
   * 
   * @return DateTime[]
   */
  public function toArray(): array {
    $result = [];
    foreach ($this as $dateTime) {
      $result[] = DateTime::from($dateTime);
    }
    return $result;
  }

}
