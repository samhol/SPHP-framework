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
use DateTimeInterface;

/**
 * Implements a datetime object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DateTime extends DateTimeImmutable {

  /**
   * Creates a new instance from input
   * 
   * @param  DateInterface|DateTimeInteface|string|int|null $date raw datetime data
   * @return DateTime new instance
   * @throws DateTimeException if date cannot be parsed from input
   */
  public static function from($date = null): DateTime {
    try {
      $dateTime = null;
      if (is_string($date)) {
        $dateTime = new DateTime($date);
      } else if (is_int($date)) {
        $dateTime = (new DateTime())->setTimestamp($date);
      } else if ($date instanceof DateInterface || $date instanceof DateTimeInterface) {
        $dateTime = new DateTime($date->format(DATE_ATOM));
      } else if (is_null($date)) {
        $dateTime = new DateTime();
      }
    } catch (\Exception $ex) {
      throw new DateTimeException($ex->getMessage(), $ex->getCode(), $ex);
    }
    return $dateTime;
  }

}
