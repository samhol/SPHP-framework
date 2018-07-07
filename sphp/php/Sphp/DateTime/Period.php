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
use Sphp\DateTime\Exceptions\DateTimeException;

/**
 * Implements a date period
 *
 * A date period allows iteration over a set of dates and times, recurring at 
 * regular intervals, over a given period.
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Period extends DatePeriod {

  /**
   * Checks if the given date is in the range
   * 
   * @param  DateInterface|DateTimeInteface|string|int|null $date the date to match
   * @return bool true if given datetime is in range
   * @throws DateTimeException if date cannot be parsed from input
   */
  public function isInRange($date): bool {
    $dateTime = DateTime::from($date);
    $start = $dateTime->isLaterThan($this->getStartDate(), false);
    $stop = $dateTime->isEarlierThan($this->getEndDate(), false);
    var_dump($this->getStartDate()->format('Y-m-d h:i:s'), $start, $stop, $start && $stop);
    return $start && $stop;
  }

  /**
   * Creates a new instance from input
   * 
   * @param  DateInterface|DateTimeInteface|string|int|null $date raw datetime data
   * @return Period new instance
   * @throws DateTimeException if date cannot be parsed from input
   */
  public static function from($start, $end): Period {
    try {
      if (is_string($start)) {
        $start = new \DateTimeImmutable($start);
      }
      if (is_string($end)) {
        $end = new \DateTimeImmutable($end);
      }
      $dateTime = new Period($start, new DateInterval('P1D'), $end);
    } catch (\Exception $ex) {
      throw new DateTimeException($ex->getMessage(), $ex->getCode(), $ex);
    }
    return $dateTime;
  }

}
