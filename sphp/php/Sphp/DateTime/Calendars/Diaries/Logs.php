<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries;

use Sphp\DateTime\DateInterface;
use Sphp\DateTime\Constraints;
use Sphp\DateTime\Constraints\Unique;
use Sphp\DateTime\Constraints\Annual;
use Sphp\DateTime\Constraints\VaryingAnnual;
use Sphp\DateTime\Constraints\Weekly;
use Sphp\DateTime\Constraints\Monthly;
use Sphp\DateTime\Constraints\Between;
use Sphp\DateTime\Constraints\Before;
use Sphp\DateTime\Constraints\After;
use Sphp\DateTime\Constraints\OneOf;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Implements an event factory
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Logs {

  /**
   * Creates a new unique date log instance
   * 
   * @param  DateInterface|\DateTimeInteface|string|int|null $date raw date data
   * @param  string $heading heading of the note 
   * @param  string $description
   * @return BasicLog new instance
   * @throws InvalidArgumentException if date parameter represents no calendar date
   */
  public static function unique($date, string $heading, string $description = null): BasicLog {
    $constraint = new Unique($date);
    return new BasicLog($constraint, $heading, $description);
  }

  /**
   * Creates a new annual log instance
   * 
   * @param  int $month
   * @param  int $day
   * @param  string $name
   * @param  string $description
   * @return BasicLog new instance
   */
  public static function annual(int $month, int $day, string $name, string $description = null): BasicLog {
    $constraint = new Annual($month, $day);
    return new BasicLog($constraint, $name, $description);
  }

  /**
   * Creates a new annual varying log instance
   * 
   * @param  string $format 
   * @param  string $name
   * @param  string $description
   * @return BasicLog new instance
   */
  public static function varyingAnnual(string $format, string $name, string $description = null): BasicLog {
    $constraint = new VaryingAnnual($format);
    return new BasicLog($constraint, $name, $description);
  }

  /**
   * Creates a new weekly occurring log instance
   * 
   * @param  int $day the day of the month
   * @param  string $name
   * @param  string $description
   * @return BasicLog new instance
   */
  public static function monthly(int $day, string $name, string $description = null): BasicLog {
    $constraint = new Monthly($day);
    return new BasicLog($constraint, $name, $description);
  }

  /**
   * Creates a new weekly occurring log instance
   * 
   * @param  int[] $weekdays week days the holiday occurs
   * @param  string $name
   * @param  string $description
   * @return BasicLog new instance
   */
  public static function weekly(array $weekdays, string $name, string $description = null): BasicLog {
    $reflect = new \ReflectionClass(Weekly::class);
    $constraint = $reflect->newInstanceArgs($weekdays);
    return new BasicLog($constraint, $name, $description);
  }

  /**
   * Creates a new inRange occurring log instance
   * 
   * @param  mixed $start
   * @param  mixed $stop
   * @param  string $name
   * @param  string $description
   * @return BasicLog new instance
   */
  public static function between($start, $stop, string $name, string $description = null): BasicLog {
    $constraint = new Between($start, $stop);
    return new BasicLog($constraint, $name, $description);
  }

  /**
   * Creates a new inRange occurring log instance
   * 
   * @param  mixed $limit week days the holiday occurs
   * @param  string $name
   * @param  string $description
   * @return BasicLog new instance
   */
  public static function before($limit, string $name, string $description = null): BasicLog {
    $constraint = new Before($limit);
    return new BasicLog($constraint, $name, $description);
  }

  /**
   * Creates a new inRange occurring log instance
   * 
   * @param  mixed $limit week days the holiday occurs
   * @param  string $name
   * @param  string $description
   * @return BasicLog new instance
   */
  public static function after($limit, string $name, string $description = null): BasicLog {
    $constraint = new After($limit);
    return new BasicLog($constraint, $name, $description);
  }

  /**
   * Creates a new inRange occurring log instance
   * 
   * @param  mixed $dates dates the holiday occurs
   * @param  string $name
   * @param  string $description
   * @return BasicLog new instance
   */
  public static function oneOf(array $dates, string $name, string $description = null): BasicLog {
    $reflect = new \ReflectionClass(OneOf::class);
    $constraint = $reflect->newInstanceArgs($dates);
    return new BasicLog($constraint, $name, $description);
  }

}
