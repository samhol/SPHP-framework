<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime;

use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Exceptions\BadMethodCallException;

/**
 * Implements a date period factory
 *
 * @method \Sphp\DateTime\Period Period months(mixed $start, string|DateInterval $length, int $recurrences = 1) Creates a new monthly recurrence instance from input
 * @method \Sphp\DateTime\Period m(mixed $start, string|DateInterval $interval, int $recurrences = 1) Creates a new monthly recurrence instance from input
 * @method \Sphp\DateTime\Period weeks(mixed $start, string|DateInterval $interval, int $recurrences = 1) Creates a new weekly recurrences instance from input
 * @method \Sphp\DateTime\Period w(mixed $start, string|DateInterval $interval, int $recurrences = 1) Creates a new weekly recurrences instance from input
 * @method \Sphp\DateTime\Period hours(mixed $start, string|DateInterval $interval, int $recurrences = 1) Creates a new hourly recurrences instance from input
 * @method \Sphp\DateTime\Period h(mixed $start, string|DateInterval $interval, int $recurrences = 1) Creates a new hourly recurrences instance from input
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class Periods {

  /**
   * @var string[]
   */
  private static $periodMap = [
      'months' => '%d months',
      'weeks' => '%d weeks',
      'hours' => '%d hours',
      'h' => '%d hours',
      'weeksOfMonth' => '%d hours',
  ];

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
    $interval = Intervals::create($intervalStr);
    return static::create($arguments[0], $interval, $arguments[1]);
  }

  /**
   * Creates a new instance from input
   * 
   * @param  mixed $start the start date of the period
   * @param  string|Interval $interval
   * @param  mixed $length the end date or the length of the period
   * @return Period new instance
   * @throws InvalidArgumentException if instance cannot be parsed from input
   */
  public static function create($start, $interval, $length): Period {
    try {
      if (is_string($interval)) {
        $interval = Intervals::create($interval);
      }
      if (!is_int($length)) {
        $length = DateTimes::dateTimeImmutable($length);
      }
      $dateTime = new \DatePeriod(DateTimes::dateTimeImmutable($start), $interval, $length);
      $p = new Period($dateTime);
    } catch (\Exception $ex) {
      throw new InvalidArgumentException($ex->getMessage(), $ex->getCode(), $ex);
    }
    return $p;
  }

  /**
   * Creates a new instance from input
   * 
   * @param int $month
   * @param int $year
   * @return Period new instance
   * @throws InvalidArgumentException if instance cannot be parsed from input
   */
  public static function weeksOfMonth(int $month = null, int $year = null): Period {
    if ($year === null) {
      $year = Date('Y');
    }
    if ($month === null) {
      $month = Date('m');
    }
    $d = DateTime::from("$year-$month-1 00:00:00");
    $start = $d->modify('last monday');

    $stop = $d->modify('last day of')->modify('next sunday');
    //  echo 'foo..'. $start->format('Y-m-d D');
    $p = new \DatePeriod($start->getDateTime(), new Interval('P1W'), $stop->getDateTime());
    return new Period($p);
  }

  /**
   * 
   * @param  mixed $first
   * @param  int $num
   * @return Period new instance
   */
  public static function days($first, int $num): Period {
    // echo "\n|||days:". DateTimes::dateTimeImmutable($first)->format('Y-m-d D');
    $p = new \DatePeriod(DateTimes::dateTimeImmutable($first), new Interval('P1D'), $num);
    return new Period($p);
  }

}
