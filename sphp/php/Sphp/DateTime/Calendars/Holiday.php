<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars;

use Sphp\DateTime\DateInterface;
use Sphp\DateTime\Date;
use Sphp\DateTime\Exceptions\DateTimeException;

/**
 * Implements a holiday note for a calendar
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Holiday implements CalendarDateNote {

  /**
   * @var bool 
   */
  private $national = false;

  /**
   * @var bool 
   */
  private $flagDay = false;

  /**
   * @var Date 
   */
  private $date;

  /**
   * @var string 
   */
  private $name;

  /**
   * Constructor
   * 
   * @param DateInterface $date 
   * @param string $name
   */
  public function __construct(DateInterface $date, string $name) {
    $this->date = $date;
    $this->name = $name;
  }

  public function getDate(): Date {
    return $this->date;
  }

  public function getName(): string {
    return $this->name;
  }

  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  public function setFlagDay(bool $flagDay = true) {
    $this->flagDay = $flagDay;
    return $this;
  }

  public function isFlagDay(): bool {
    return $this->flagDay;
  }

  public function isNationalHoliday(): bool {
    return $this->national;
  }

  public function setNationalHoliday(bool $national = true) {
    $this->national = $national;
    return $this;
  }

  public function __toString(): string {
    $output = "$this->name: ";
    $output .= $this->date->format('l, Y-m-d');
    if ($this->isNationalHoliday()) {
      $output .= " (national holiday)";
    }
    if ($this->isFlagDay()) {
      $output .= " (flagday)";
    }
    return $output;
  }

  /**
   * Creates a new instance from a date string
   * 
   * @param  DateInterface|DateTimeInteface|string|int|null $date raw date data
   * @param  string $name name of the holiday 
   * @return Holiday new instance
   * @throws DateTimeException if creation fails
   */
  public static function from($date, string $name): Holiday {
    try {
      return new static(Date::from($date), $name);
    } catch (\Exception $ex) {
      throw new DateTimeException($ex->getMessage(), $ex->getCode(), $ex);
    }
  }

  /**
   * Creates a new instance from a unix timestamp
   * 
   * @param  int $timestamp unix timestamp
   * @param  string $name name of the holiday 
   * @return Holiday new instance
   */
  public static function fromTimestamp(int $timestamp, string $name): Holiday {
    return new static(Date::fromTimestamp($timestamp), $name);
  }

  /**
   * Creates a new instance from a date string
   * 
   * @param  string $dateString date string
   * @param  string $name name of the holiday 
   * @return Holiday new instance
   */
  public static function fromDateString(string $dateString, string $name): Holiday {
    return new static(Date::fromString($dateString), $name);
  }

}
