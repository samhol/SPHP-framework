<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\DateTime;

use DateTimeInterface;
use Sphp\DateTime\DateInterface;

/**
 * A factory for &lt;time&gt; object creation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class DateTime {

  protected static function parseInstance($dateTime = null) {
    if (!$dateTime instanceof DateTimeInterface && !$dateTime instanceof DateInterface) {
      $dateTime = new \DateTimeImmutable($dateTime);
    }
    return $dateTime;
  }

  /**
   * Creates a &lt;time&gt; tag object showing week number
   * 
   * @param  mixed $dateTime
   * @return TimeTag new instance
   */
  public static function weekNumber($dateTime = null): TimeTag {
    $parsed = static::parseInstance($dateTime);
    return (new TimeTag($parsed, $parsed->format('W')))->setFormat(TimeTag::Y_W);
  }

  /**
   * 
   * @param  mixed $dateTime
   * @return TimeTag new instance
   */
  public static function datetime($dateTime = null): TimeTag {
    $parsed = static::parseInstance($dateTime);
    return (new TimeTag($parsed, $parsed->format(TimeTag::DATE_TIME)))->setFormat(TimeTag::DATE_TIME);
  }

}
