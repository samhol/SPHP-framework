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

use DateInterval;
use Sphp\Stdlib\Strings;
use Sphp\DateTime\Exceptions\InvalidArgumentException;

/**
 * Implements a factory for basic interval object creation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class Intervals {

  /**
   * Parses a new instance of interval from mixed input
   * 
   * @param  mixed $input input for a new interval
   * @return Interval new instance
   * @throws InvalidArgumentException
   */
  public static function create($input): Interval {
    if ($input instanceof Interval) {
      $interval = clone $input;
    } else if ($input instanceof DateInterval) {
      $interval = static::fromDateInterval($input);
    } else if (is_numeric($input)) {
      $interval = static::fromSeconds((float) $input);
    } else if (is_string($input)) {
      $interval = static::fromString($input);
    } else {
      throw new InvalidArgumentException('Cannot parse Interval from given input');
    }
    return $interval;
  }

  /**
   * Creates a new instance of interval from a string
   * 
   * @param  string $input
   * @return Interval new instance
   * @throws InvalidArgumentException
   */
  public static function fromString(string $input): Interval {
    if (Strings::match($input, "/^([0-9]+):([0-5][0-9])(:[0-5][0-9])?$/")) {
      $parts = explode(':', $input);
      $dateint = 'PT' . $parts[0] . 'H' . $parts[1] . 'M' . $parts[2] . "S";
      //echo "$dateint\n";
      $interval = new Interval($dateint);
    } else if (Strings::startsWith($input, "P")) {
      $interval = new Interval($input);
    } else {
      $interval = Interval::createFromDateString($input);
    }
    return $interval;
  }

  /**
   * Creates a new instance of interval from a numeric value
   * 
   * @param  float $seconds 
   * @return Interval new instance
   */
  public static function fromSeconds(float $seconds): Interval {
    $interval = new Interval;
    return $interval->addSeconds($seconds);
  }

  /**
   * 
   * @param  DateInterval $input
   * @return Interval new instance
   */
  public static function fromDateInterval(DateInterval $input): Interval {
    $vars = get_object_vars($input);
    //var_dump($vars);
    $output = new Interval;
    foreach ($vars as $key => $value) {
      $output->$key = $value;
    }
    return $output;
  }

}
