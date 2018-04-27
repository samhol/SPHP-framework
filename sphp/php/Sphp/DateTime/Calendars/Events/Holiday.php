<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Events;

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
class Holiday extends AbstractHoliday {

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
    parent::__construct($name);
    $this->date = $date;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->date);
    parent::__destruct();
  }

  /**
   * 
   * @return Date
   */
  public function getDate(): Date {
    return $this->date;
  }

  /**
   * 
   * @return bool
   */
  public function dateMatchesWith(DateInterface $date): bool {
    return $this->date->matchesWith($date);
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
