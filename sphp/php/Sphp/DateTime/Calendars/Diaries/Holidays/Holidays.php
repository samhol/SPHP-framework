<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries\Holidays;

use Sphp\DateTime\DateInterface;
use Sphp\DateTime\Calendars\Diaries\Constraints;

/**
 * Implements a holiday event factory
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Holidays {

  /**
   * Creates a new Holiday instance from a date string
   * 
   * @param  DateInterface|\DateTimeInteface|string|int|null $date raw date data
   * @param  string $name name of the holiday 
   * @return Holiday new instance
   * @throws DateTimeException if creation fails
   */
  public static function unique($date, string $name): Holiday {
    $constraint = new Constraints\Unique($date);
    return new Holiday($constraint, $name);
  }

  /**
   * 
   * @param int $month
   * @param int $day
   * @param string $name
   * @return Holiday new instance
   */
  public static function annual(int $month, int $day, string $name): Holiday {
    $constraint = new Constraints\Annual($month, $day);
    return new Holiday($constraint, $name);
  }

  /**
   * Creates a new annual varying Holiday instance
   * 
   * @param  string $format 
   * @param  string $name
   * @return Holiday
   */
  public static function varyingAnnual(string $format, string $name): Holiday {
    $constraint = new Constraints\VaryingAnnual($format);
    return new Holiday($constraint, $name);
  }

  /**
   * Creates a new birthday instance
   * 
   * @param  int $month the month
   * @param  int $day the day of the month
   * @param  string $name
   * @param  int $yearOfBirth
   * @return BirthDay new instance
   */
  public static function birthday(int $month, int $day, string $name, int $yearOfBirth = null): BirthDay {
    return new BirthDay($month, $day, $name, $yearOfBirth);
  }

  /**
   * Creates a new weekly occuring Holiday instance
   * 
   * @param  int[] $weekdays week days the holiday occurs
   * @param  string $name
   * @param  string $description
   * @return Holiday new instance
   */
  public static function weekly(array $weekdays, string $name, string $description = null): Holiday {
    $reflect = new ReflectionClass(Constraints\Weekly::class);
    $constraint = $reflect->newInstanceArgs($weekdays);
    return new Holiday($constraint, $name, $description);
  }

}
