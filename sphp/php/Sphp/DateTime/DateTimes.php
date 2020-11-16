<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime;

use DateTimeImmutable;
use Sphp\Exceptions\InvalidArgumentException;
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
   * @param  mixed $input
   * @return DateTimeImmutable
   * @throws InvalidArgumentException
   */
  public static function dateTimeImmutable($input): DateTimeImmutable {
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
      $out = new DateTimeImmutable("@$input");
      $out->setTimezone(new \DateTimeZone(date_default_timezone_get()));
    } else if ($input instanceof \DateTimeInterface || $input instanceof DateInterface) {
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
    if (is_null($input)) {
      return date('Y-m-d');
    } else if (is_string($input)) {
      return (new DateTimeImmutable($input))->format('Y-m-d');
    } else if (is_int($input)) {
      return date('Y-m-d', $input);
    } else if ($input instanceof DateInterface || $input instanceof \DateTimeInterface) {
      return $input->format('Y-m-d');
    } else {
      throw new InvalidArgumentException('Date string cannot be parsed from the input');
    }
  }

}
