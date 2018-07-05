<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime;

use Sphp\DateTime\DateInterval;
use Sphp\Stdlib\Strings;

/**
 * Description of Factory
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Factory {

  public static function timeDiff(string $time): DateInterval {
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

}
