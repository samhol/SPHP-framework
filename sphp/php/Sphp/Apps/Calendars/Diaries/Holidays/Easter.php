<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Calendars\Diaries\Holidays;

use Sphp\DateTime\ImmutableDate;
use Sphp\DateTime\Date;
use IteratorAggregate;
use Traversable;
use ArrayIterator;

/**
 * The Easter class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Easter implements IteratorAggregate {

  /**
   * @var int
   */
  private $year;

  /**
   * Constructor
   * 
   * @param int|null $year optional year (uses current if omitted) 
   */
  public function __construct(?int $year = null) {
    if ($year === null) {
      $year = (int) date('Y');
    }
    $this->year = $year;
  }

  /**
   * Returns the year
   * 
   * @return int the year
   */
  public function getYear(): int {
    return $this->year;
  }

  /**
   * Returns the Maundy Thursday
   * 
   * @return Date new date object
   */
  public function getMaundyThursday(?int $year = null): Date {
    return $this->getEasterSunday($year)->jumpDays(-3);
  }

  /**
   * Returns the Good Friday
   * 
   * @return Date new date object
   */
  public function getGoodFriday(?int $year = null): Date {
    return $this->getEasterSunday($year)->jumpDays(-2);
  }

  /**
   * Returns the Easter Sunday
   * 
   * @param  int|null $year
   * @return Date new date object
   */
  public function getEasterSunday(?int $year = null): Date {
    if ($year === null) {
      $year = $this->year;
    }
    $base = new \DateTimeImmutable("$year-03-21");
    $days = easter_days($year);
    $b = $base->add(new \DateInterval("P{$days}D"));
    return new ImmutableDate($b);
  }

  /**
   * Returns the Easter Monday
   * 
   * @param int|null $year
   * @return Date new date object
   */
  public function getEasterMonday(?int $year = null): Date {
    return $this->getEasterSunday($year)->jumpDays(1);
  }

  /**
   * Returns the Ascension Day
   *  
   * @param int|null $year
   * @return Date new date object
   */
  public function getAscensionDay(?int $year = null): Date {
    return $this->getEasterSunday($year)->jumpDays(39);
  }

  /**
   * Returns the Pentecost Day
   *
   * @param  int|null $year
   * @return Date new date object
   */
  public function getPentecost(?int $year = null): Date {
    return $this->getEasterSunday($year)->jumpDays(49);
  }

  public function toArray(): array {
    $easter = [];
    $adder = function (ImmutableDate $date) use ($easter): void {
      $easter[$date->format('Y-m-d')] = $date;
    };
    $adder($this->getMaundyThursday());
    $adder($this->getMaundyThursday());
    $adder($this->getGoodFriday());
    $adder($this->getEasterSunday());
    $adder($this->getEasterMonday());
    $adder($this->getAscensionDay());
    $adder($this->getPentecost());
    return $easter;
  }

  public function getIterator(): Traversable {
    return new ArrayIterator($this->toArray());
  }

}
