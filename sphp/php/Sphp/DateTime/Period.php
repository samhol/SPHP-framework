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
use Sphp\DateTime\Constraints\Constraints;
use IteratorAggregate;
use Exception;

/**
 * Implements a date period
 *
 * A date period allows iteration over a set of dates and times, recurring at 
 * regular intervals, over a given period.
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Period implements IteratorAggregate, PeriodInterface {

  /**
   * @var DatePeriod 
   */
  private $datePeriod;

  /**
   * @var Constraints 
   */
  private $constraints;

  public function __construct(DatePeriod $period) {
    $this->datePeriod = $period;
    $this->constraints = new Constraints();
  }

  /**
   * Checks if the given date is in the range
   * 
   * @param  mixed $date the date to match
   * @return bool true if given datetime is in the period
   */
  public function containsDate($date): bool {
    $result = false;
    try {
      $dateObj = Date::from($date);
      foreach ($this as $dateTime) {
        if ($dateObj->compareTo($dateTime) === 0) {
          $result = true;
          break;
        }
      }
    } catch (Exception $ex) {
      return false;
    }
    return $result;
  }

  public function restrictions(): Constraints {
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
   * @return SingleTask[]
   */
  public function toArray(): array {
    $output = [];
    foreach ($this->datePeriod as $dateTime) {
      if ($this->constraints->isValid($dateTime)) {
        $output[] = DateTime::from($dateTime);
      }
    }
    return $output;
  }

  public function getIterator(): \Traversable {
    return new \ArrayIterator($this->toArray());
  }

  public function getInterval(): Interval {
    $this->datePeriod->getDateInterval();
  }

  public function getStartDate(): DateTimeInterface {
    return DateTime::from($this->datePeriod->getStartDate());
  }

  public function getEndDate(): DateTimeInterface {
    return DateTime::from($this->datePeriod->getEndDate());
  }

  public static function fromISO(string $isoString): Period {
    $datePeriod = new \DatePeriod($isoString);
    return new static($datePeriod);
  }

}
