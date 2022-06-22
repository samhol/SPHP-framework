<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime;

use Sphp\DateTime\Exceptions\InvalidArgumentException;
use DateTimeZone;

/**
 * Class TimeZones
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
abstract class TimeZones {

  /**
   * 
   * @param  string $param
   * @return DateTimeZone
   * @throws InvalidArgumentException
   */
  public static function fromString(string $param = null): DateTimeZone {
    try {
      if ($param === null) {
        $param = date_default_timezone_get();
      }
      $tz = new DateTimeZone((string) $param);
    } catch (\Exception $ex) {
      throw new InvalidArgumentException('Invalid timezonew paramater provided', $ex->getCode(), $ex);
    }
    return $tz;
  }

  /**
   * 
   * @param  float $hours
   * @return DateTimeZone
   * @throws InvalidArgumentException
   */
  public static function fromHours(float $hours): DateTimeZone {
    if (-12 > $hours || $hours > 14) {
      throw new InvalidArgumentException('Invalid timezone offset hours paramater provided');
    }
    $interval = Interval::fromSeconds($hours * 3600);
    $param = $interval->format("%R%H:%I");
    return self::fromString($param);
  }

  /**
   * 
   * @param  float $seconds
   * @return DateTimeZone
   * @throws InvalidArgumentException
   */
  public static function fromSeconds(float $seconds): DateTimeZone {
    try {
      return self::fromHours($seconds / 3600);
    } catch (\Exception $ex) {
      throw new InvalidArgumentException("Invalid timezone offset seconds paramater ($seconds s) provided", 0, $ex);
    }
  }

}
