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
use Sphp\DateTime\DateTime;
/**
 * Description of DateTimes
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Factory {

  /**
   * 
   * @param  mixed $dateTime
   * @return TimeTag
   */
  public static function weekNumber($dateTime = null): TimeTag {
    if (!$dateTime instanceof DateTimeInterface && !$dateTime instanceof DateTime) {
      $dateTime = new DateTime($dateTime);
    }
    return (new TimeTag($dateTime, $dateTime->format('W')))->setFormat(TimeTag::Y_W);
  }
  /**
   * 
   * @param  mixed $dateTime
   * @return TimeTag
   */
  public static function datetime($dateTime = null): TimeTag {
    if (!$dateTime instanceof DateTimeInterface && !$dateTime instanceof DateTime) {
      $dateTime = new DateTime($dateTime);
    }
    return (new TimeTag($dateTime, $dateTime->format(TimeTag::DATE_TIME)))->setFormat(TimeTag::DATE_TIME);
  }

}
