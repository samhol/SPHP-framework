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
use Sphp\DateTime\Constraints;
use Sphp\DateTime\Constraints\Unique;
use Sphp\DateTime\Constraints\Annual;
use Sphp\DateTime\Constraints\VaryingAnnual;
use Sphp\DateTime\Constraints\Weekly;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Data\Person;

/**
 * Implements a holiday event factory
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Holidays {

  /**
   * Creates a new Holiday instance from a date string
   * 
   * @param  DateInterface|\DateTimeInteface|string|int|null $date raw date data
   * @param  string $name name of the holiday 
   * @return Holiday new instance
   * @throws InvalidArgumentException if creation fails
   */
  public static function unique($date, string $name): Holiday {
    $constraint = new Unique($date);
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
    $constraint = new Annual($month, $day);
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
    $constraint = new VaryingAnnual($format);
    return new Holiday($constraint, $name);
  }

  /**
   * Creates a new birthday instance
   * 
   * @param  mixed $dob date of birth
   * @param  string $name
   * @param  mixed $dod date of death (defaults to `null` which means alive)
   * @return BirthDay new instance
   */
  public static function birthday($dob, string $name, $dod = null): BirthDay {
    $person = new Person();
    try {
      $person->setDateOfBirth($dob);
    } catch (\Exception $ex) {
      throw new InvalidArgumentException('Date Of birth is not a correct date', $ex->getCode(), $ex);
    }
    $parts = explode(',', $name);
    //var_dump($parts);
    $fname = $parts[0];
    $person->setFname($fname);
    $person->setLname($parts[1]);
    if ($dod !== null) {
      try {
      $person->setDateOfDeath($dod);
    } catch (\Exception $ex) {
      throw new InvalidArgumentException('Date Of death is not null or a correct date', $ex->getCode(), $ex);
    }
    }
    return new BirthDay($person);
  }

  /**
   * Creates a new weekly occurring Holiday instance
   * 
   * @param  int[] $weekdays week days the holiday occurs
   * @param  string $name
   * @param  string $description
   * @return Holiday new instance
   */
  public static function weekly(array $weekdays, string $name, string $description = null): Holiday {
    $reflect = new ReflectionClass(Weekly::class);
    $constraint = $reflect->newInstanceArgs($weekdays);
    return new Holiday($constraint, $name, $description);
  }

}
