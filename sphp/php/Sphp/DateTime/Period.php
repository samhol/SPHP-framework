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
use Sphp\DateTime\Exceptions\DateTimeException;
use Sphp\Exceptions\BadMethodCallException;
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
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Period extends DatePeriod implements Arrayable {

  /**
   * @var string[]
   */
  private static $periodMap = [
      'months' => '%d months',
      'm' => '%d months',
      'weeks' => '%d weeks',
      'w' => '%d weeks',
      'days' => '%d days',
      'd' => '%d days',
      'hours' => '%d hours',
      'h' => '%d hours',
  ];

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

  /**
   * Creates a period object
   *
   * @param  string $name the name of the component
   * @param  array $arguments 
   * @return Period new instance
   * @throws BadMethodCallException
   */
  public static function __callStatic(string $name, array $arguments): Period {
    $num = 1;
    if (!isset(static::$periodMap[$name])) {
      throw new BadMethodCallException("Method $name does not exist");
    }
    if (count($arguments) >= 3) {
      $num = (int) $arguments[2];
    }
    $intervalStr = sprintf(static::$periodMap[$name], $num);
    if ($num > 0) {
      $intervalStr = "+$intervalStr";
    }
    $interval = Interval::createFromDateString($intervalStr);
    //if ($num < 0) {
    //  $interval->invert = 1;
    //}
    // $interval = Factory::dateInterval($intervalStr);
    echo $intervalStr;
    return static::create($arguments[0], $interval, $arguments[1]);
  }

  /**
   * Creates a new instance from input
   * 
   * @param  mixed $start the start date of the period
   * @param  string|Interval $interval
   * @param  mixed $length the end date or the length of the period
   * @return Period new instance
   * @throws DateTimeException if instance cannot be parsed from input
   */
  public static function create($start, $interval, $length): Period {
    try {
      if (is_string($interval)) {
        $interval = Factory::dateInterval($interval);
      }
      if (!is_int($length)) {
        $length = Factory::dateTimeImmutable($length);
      }
      $dateTime = new static(Factory::dateTimeImmutable($start), $interval, $length);
    } catch (\Exception $ex) {
      throw new DateTimeException($ex->getMessage(), $ex->getCode(), $ex);
    }
    return $dateTime;
  }

}
