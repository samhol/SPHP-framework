<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime;

use DatePeriod;
use Sphp\Stdlib\Datastructures\Arrayable;
use Sphp\DateTime\Constraints\Constraints;
use IteratorAggregate;
use Traversable;
use ArrayIterator;
use Sphp\DateTime\Date;

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
class Period implements IteratorAggregate, Arrayable {

  /**
   * @var DatePeriod 
   */
  private DatePeriod $datePeriod;

  /**
   * @var Constraints 
   */
  private Constraints $constraints;

  /**
   * Constructor
   * 
   * @param DatePeriod $period
   */
  public function __construct(DatePeriod $period) {
    $this->datePeriod = $period;
    $this->constraints = new Constraints();
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->datePeriod, $this->constraints);
  }

  /**
   * Checks if the given date is in the range
   * 
   * @param  Date $date the date to match
   * @return bool true if given datetime is in the period
   */
  public function contains(Date $date): bool {
    $result = false;
    $isDateTime = $date instanceof DateTime;
    foreach ($this as $dateTime) {
      if ($isDateTime && $date->compareTo($dateTime) === 0) {
        $result = true;
        break;
      } else if (!$isDateTime && $date->dateEqualsTo($dateTime)) {
        $result = true;
        break;
      }
    }
    return $result;
  }

  public function restrictions(): Constraints {
    return $this->constraints;
  }

  /**
   * 
   * @return DateTime[]
   */
  public function toArray(): array {
    $output = [];
    foreach ($this->datePeriod as $dateTime) {
      if ($this->constraints->isValid(ImmutableDate::from($dateTime))) {
        $output[] = ImmutableDateTime::from($dateTime);
      }
    }
    return $output;
  }

  /**
   * Create a new iterator to iterate through inserted elements in the container
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    return new ArrayIterator($this->toArray());
  }

  public function getInterval(): Interval {
    return Intervals::fromDateInterval($this->datePeriod->getDateInterval());
  }

  public function getStartDate(): DateTime {
    return ImmutableDateTime::from($this->datePeriod->getStartDate());
  }

  public function getEndDate(): DateTime {
    $date = $this->datePeriod->getEndDate();
    if ($date === null) {
      $dts = $this->toArray();
      // print_r($this->dts );
      $date = array_pop($dts);
    }
    return $date;
  }

  public static function fromISO(string $isoString): Period {
    $datePeriod = new \DatePeriod($isoString);
    return new static($datePeriod);
  }

}
