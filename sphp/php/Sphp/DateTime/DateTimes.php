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

use DateTimeImmutable;
use Sphp\DateTime\Exceptions\InvalidArgumentException;
use Exception; 

/**
 * Implements a factory for basic datetime object creation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class DateTimes {

  /**
   * Parses a datetime object from input
   * 
   * 
   * * int: treated as timestamps
   * * float: treated as timestamps with microseconds fractions
   * 
   * @param  mixed $input
   * @return DateTimeImmutable
   * @throws InvalidArgumentException
   */
  public static function dateTimeImmutable($input = 'now'): DateTimeImmutable {
    if ($input === null) {
      $input = 'now';
    }
    if ($input instanceof DateTimeImmutable) {
      $out = $input;
    } else if (is_string($input)) {
      try {
        $out = new DateTimeImmutable($input);
      } catch (Exception $ex) {
        throw new InvalidArgumentException($ex->getMessage(), $ex->getCode(), $ex);
      }
    } else if (is_int($input)) {
      $out = DateTimeImmutable::createFromFormat('U', (string) $input);
    } else if (is_float($input)) {
      $out = DateTimeImmutable::createFromFormat('U.u', (string) $input);
    } else if ($input instanceof \DateTime) {
      $out = DateTimeImmutable::createFromMutable($input);
    } else if ($input instanceof ImmutableDateTime) {
      $dateTimeString = $input->getDateTime();
      $out = $input->getDateTime();
    } else if ($input instanceof ImmutableDate) {
      $out = $input->getDateTime();
    } else if ($input instanceof Date) {
      $dateTimeString = $input->format('Y-m-d\TH:i:sP');
      $out = new DateTimeImmutable($dateTimeString);
    } else {
      throw new InvalidArgumentException('Datetime object cannot be parsed from input type');
    }
    return $out;
  }

  /**
   * Parses a date string from input
   * 
   * @param  mixed $input input to parse
   * @return string date string as `Y-m-d` 
   * @throws InvalidArgumentException if parsing fails
   */
  public static function parseDateString($input): string {
    return static::dateTimeImmutable($input)->format('Y-m-d');
  }

  /**
   * 
   * @param  mixed $date
   * @param  int $months
   * @return DateTimeImmutable
   * @throws InvalidArgumentException on failure
   */
  public static function addMonths($date, int $months): DateTimeImmutable {
    $date = self::dateTimeImmutable($date);
    $years = floor(abs($months / 12));
    $leap = 29 <= $date->format('d');
    $m = 12 * (0 <= $months ? 1 : -1);
    for ($a = 1; $a < $years; ++$a) {
      $date = static::addMonths($date, $m);
    }
    $months -= ($a - 1) * $m;
    $init = clone $date;
    if (0 != $months) {
      $modifier = $months . ' months';

      $date = $date->modify($modifier);
      if ($date->format('m') % 12 != (12 + $months + $init->format('m')) % 12) {
        $day = $date->format('d');
        $init = $init->modify("-{$day} days");
      }
      $init = $init->modify($modifier);
    }
    $y = $init->format('Y');
    if ($leap && ($y % 4) == 0 && ($y % 100) != 0 && 28 == $init->format('d')) {
      $init = $init->modify('+1 day');
    }
    return $init;
  }

}
