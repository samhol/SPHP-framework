<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime;

use DateTimeImmutable;
use DateTimeInterface as DTI;
use Sphp\Exceptions\InvalidArgumentException;
use Exception;

/**
 * Implements a factory for basic datetime object creation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
abstract class DateTimes {

  /**
   * parses a datetime object from input
   * 
   * @param  mixed $input
   * @return DateTimeImmutable
   * @throws InvalidArgumentException
   */
  public static function dateTimeImmutable($input): DateTimeImmutable {
    try {
      if ($input === null) {
        $dateTime = new DateTimeImmutable('now');
      } else if ($input instanceof DateTimeImmutable) {
        $dateTime = $input;
      } else if (is_string($input)) {
        $dateTime = new DateTimeImmutable($input);
      } else if (is_int($input)) {
        $dateTime = new DateTimeImmutable("@$input");
      } else if ($input instanceof DTI) {
        $dateTime = DateTimeImmutable::createFromMutable($input);
      } else if ($input instanceof DateInterface) {
        $timestamp = $input->getTimestamp();
        $dateTime = new DateTimeImmutable("@$timestamp");
      }
    } catch (Exception $ex) {
      throw new InvalidArgumentException($ex->getMessage(), $ex->getCode(), $ex);
    }
    if (!$dateTime instanceof DateTimeImmutable) {
      throw new InvalidArgumentException('Datetime object cannot be parsed from input type');
    }
    return $dateTime;
  }

  /**
   * Parses a date string from input
   * 
   * @param  mixed $input input to parse
   * @return string date string as `Y-m-d` 
   * @throws InvalidArgumentException if parsing fails
   */
  public static function parseDateString($input): string {
    $result = null;
    if (is_null($input)) {
      $result = date('Y-m-d');
    } else if (is_string($input)) {
      $result = (new DateTimeImmutable($input))->format('Y-m-d');
    } else if (is_int($input)) {
      $result = date('Y-m-d', $input);
    } else if ($input instanceof DateInterface || $input instanceof \DateTimeInterface) {
      $result = $input->format('Y-m-d');
    }
    if ($result === null) {
      throw new InvalidArgumentException('Date string cannot be parsed from the input');
    }
    return $result;
  }

}
