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

/**
 * Implements an event factory
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Events {

  /**
   * Creates a new unique date note instance
   * 
   * @param  DateInterface|\DateTimeInteface|string|int|null $date raw date data
   * @param  string $heading heading of the note 
   * @param  string $description
   * @return Note new instance
   * @throws DateTimeException if date parameter represents no calendar date
   */
  public static function unique($date, string $heading, string $description = null): Note {
    $constraint = new Constraints\Unique($date);
    return new Note($constraint, $heading, $description);
  }

  /**
   * Creates a new annual note instance
   * 
   * @param int $month
   * @param int $day
   * @param string $name
   * @param  string $description
   * @return Note new instance
   */
  public static function annual(int $month, int $day, string $name, string $description = null): Note {
    $constraint = new Constraints\Annual($month, $day);
    return new Note($constraint, $name, $description);
  }

  /**
   * Creates a new annual varying Holiday instance
   * 
   * @param  string $format 
   * @param  string $name
   * @param  string $description
   * @return Note new instance
   */
  public static function varyingAnnual(string $format, string $name, string $description = null): Note {
    $constraint = new Constraints\VaryingAnnual($format);
    return new Note($constraint, $name, $description);
  }
  /**
   * Creates a new weekly occuring Holiday instance
   * 
   * @param  int $day the day of the month
   * @param  string $name
   * @param  string $description
   * @return Note new instance
   */
  public static function monthly(int $day, string $name, string $description = null): Note {
    $constraint = new Constraints\Monthly($day);
    return new Note($constraint, $name, $description);
  }

  /**
   * Creates a new weekly occuring Holiday instance
   * 
   * @param  int[] $weekdays week days the holiday occurs
   * @param  string $name
   * @param  string $description
   * @return Note new instance
   */
  public static function weekly(array $weekdays, string $name, string $description = null): Note {
    $reflect = new \ReflectionClass(Constraints\Weekly::class);
    $constraint = $reflect->newInstanceArgs($weekdays);
    return new Note($constraint, $name, $description);
  }

}
