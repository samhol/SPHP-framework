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
use Sphp\Exceptions\BadMethodCallException;
use Exception;

/**
 * Implements a date period
 *
 * A date period allows iteration over a set of dates and times, recurring at 
 * regular intervals, over a given period.
 * 
 * 
 * @method \Sphp\DateTime\Period monthly(mixed $content = null, int $colspan = 1, int $rowspan = 1) creates a new HTML &lt;td&gt; object
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Period extends DatePeriod {

  /**
   * @var string[]
   */
  private static $periodMap = array(
      'monthly' => 'P1M',
      'm' => 'P1M'
  );

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
   * Creates a period object
   *
   * @param  string $name the name of the component
   * @param  array $arguments 
   * @return Period new instance
   * @throws BadMethodCallException
   */
  public static function __callStatic(string $name, array $arguments): Period {
    if (!isset(static::$periodMap[$name])) {
      throw new BadMethodCallException("Method $name does not exist");
    }
    return static::from($arguments[0], $arguments[1], static::$periodMap[$name]);
  }

  /**
   * Creates a new instance from input
   * 
   * @param  mixed $start the start date of the period
   * @param  mixed $end the end date of the period
   * @param  string|DateInterval $interval
   * @return Period new instance
   * @throws DateTimeException if instance cannot be parsed from input
   */
  public static function from($start, $end, $interval = null): Period {
    try {
      if (is_string($interval)) {
        $interval = Factory::dateInterval($interval);
      }
      $dateTime = new static(Factory::dateTimeImmutable($start), $interval, Factory::dateTimeImmutable($end));
    } catch (\Exception $ex) {
      throw new DateTimeException($ex->getMessage(), $ex->getCode(), $ex);
    }
    return $dateTime;
  }

  /**
   * Creates a new recurrences monthly instance from input
   * 
   * @param  mixed $start the start date of the period
   * @param  mixed $end the end date of the period
   * @return Period new instance
   * @throws DateTimeException if date cannot be parsed from input
   */
  public static function monthly($start, $end): Period {
    return static::from($start, $end, 'P1M');
  }

  /**
   * Creates a new instance from input
   * 
   * @param  mixed $start the start date of the period
   * @param  mixed $end the end date of the period
   * @return Period new instance
   * @throws DateTimeException if date cannot be parsed from input
   */
  public static function weekly($start, $end): Period {
    return static::from($start, $end, 'P1W');
  }

  /**
   * Creates a new instance from input
   * 
   * @param  mixed $start the start date of the period
   * @param  mixed $end the end date of the period
   * @return Period new instance
   * @throws DateTimeException if date cannot be parsed from input
   */
  public static function daily($start, $end): Period {
    return static::from($start, $end, 'P1D');
  }

  /**
   * Creates a new instance from input
   * 
   * @param  mixed $start the start date of the period
   * @param  mixed $end the end date of the period
   * @return Period new instance
   * @throws DateTimeException if date cannot be parsed from input
   */
  public static function hourly($start, $end): Period {
    return static::from($start, $end, 'P1H');
  }

}
