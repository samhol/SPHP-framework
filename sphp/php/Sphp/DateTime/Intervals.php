<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime;

use DateInterval;
use Sphp\Stdlib\Strings;
use Sphp\Exceptions\InvalidArgumentException;

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
    try {
      if ($input instanceof Interval) {
        $interval = clone $input;
      } else if ($input instanceof DateInterval) {
        $interval = static::fromDateInterval($input);
      } else if (is_numeric($input)) {
        $interval = static::fromNumeric($input);
      } else if (is_string($input)) {
        $interval = static::fromString($input);
      } else {
        throw new InvalidArgumentException();
      }
    } catch (\Exception $ex) {
      throw new InvalidArgumentException($ex->getMessage());
    }
    return $interval;
  }

  /**
   * Creates a new instance of interval from a string
   * 
   * @param  string $time
   * @return Interval new instance
   */
  public static function fromString(string $time): Interval {
    if (Strings::match($time, "/^([0-9]+):([0-5][0-9])(:[0-5][0-9])?$/")) {
      $parts = explode(':', $time);
      $dateint = 'PT' . $parts[0] . 'H' . $parts[1] . 'M' . $parts[2] . "S";
      //echo "$dateint\n";
      $interval = new Interval($dateint);
    } else if (Strings::match($time, "/^P([0-9]+(?:[,\.][0-9]+)?Y)?([0-9]+(?:[,\.][0-9]+)?M)?([0-9]+(?:[,\.][0-9]+)?D)?(?:T([0-9]+(?:[,\.][0-9]+)?H)?([0-9]+(?:[,\.][0-9]+)?M)?([0-9]+(?:[,\.][0-9]+)?S)?)?$/")) {
      $interval = new Interval($time);
    } else {
      $interval = Interval::createFromDateString($time);
    }
    return $interval;
  }

  /**
   * Creates a new instance of interval from a numeric value
   * 
   * @param  string|float $seconds 
   * @return Interval new instance
   * @throws InvalidArgumentException if the input value is not numeric
   */
  public static function fromNumeric($seconds): Interval {
    if (!is_numeric($seconds)) {
      throw new InvalidArgumentException('Not numeric input');
    }
    $float = (int) $seconds;

    $interval = Interval::createFromDateString($float . " seconds");
    if ($float < 0) {
      $interval->invert = 1;
    }
    return $interval;
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

  /**
   * 
   * @param  DateInterval $input
   * @return string
   */
  public static function toString(DateInterval $input): string {
    $format = 'P';
    if ($input->y > 0) {
      $format .= $input->y . 'Y';
    }
    if ($input->m > 0) {
      $format .= $input->m . 'M';
    }
    if ($input->m > 0) {
      $format .= $input->d . 'D';
    }
    $time = '';
    if ($input->h > 0) {
      $time .= $input->h . 'H';
    }
    if ($input->i > 0) {
      $time .= $input->i . 'M';
    }
    if ($input->s > 0) {
      $time .= $input->s . 'S';
    }
    if ($time !== '') {
      $format .= "T$time";
    }
    return $format;
  }

}
