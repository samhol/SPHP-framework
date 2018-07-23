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
use Sphp\DateTime\DateInterval;
use Sphp\Stdlib\Strings;
use DateTimeInterface as DTI;
use Sphp\DateTime\Exceptions\DateTimeException;
use Exception;

/**
 * Implements a factory for basic datetime object creation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Factory {

  public static function dateInterval(string $time): DateInterval {
    if (Strings::match($time, "/^([0-1]?[0-9]|[2][0-3]):([0-5][0-9])(:[0-5][0-9])?$/")) {
      $parts = explode(':', $time);
      $dateint = 'PT' . $parts[0] . 'H' . $parts[1] . 'M' . $parts[2] . "S";
      //echo "$dateint\n";
      $interval = new DateInterval($dateint);
    } else {
      $interval = new DateInterval($time);
    }
    return $interval;
  }

  /**
   * parses a datetime object from input
   * 
   * @param  mixed $input
   * @return DateTimeImmutable
   * @throws DateTimeException
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
      throw new DateTimeException($ex->getMessage(), $ex->getCode(), $ex);
    }
    if (!$dateTime instanceof DateTimeImmutable) {
      throw new DateTimeException('Datetime object cannot be parsed from input type');
    }
    return $dateTime;
  }

}
