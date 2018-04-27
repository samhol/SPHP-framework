<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Events;

use Sphp\DateTime\Date;

/**
 * Implements a holiday factory
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Holidays {

  /**
   * Creates a new Holiday instance from a date string
   * 
   * @param  DateInterface|DateTimeInteface|string|int|null $date raw date data
   * @param  string $name name of the holiday 
   * @return Holiday new instance
   * @throws DateTimeException if creation fails
   */
  public static function holiday($date, string $name): Holiday {
    return new static(Date::from($date), $name);
  }

  public static function annualHoliday(int $month, int $day, string $name): AnnualHoliday {
    return new AnnualHoliday($month, $day, $name);
  }

  public static function birthday(int $month, int $day, string $name, int $yearOfBirth = null): BirthDay {
    return new BirthDay($month, $day, $name, $yearOfBirth);
  }

}
