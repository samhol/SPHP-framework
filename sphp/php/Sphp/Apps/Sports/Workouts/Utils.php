<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Sports\Workouts;

use Sphp\DateTime\Duration;

/**
 * Class Utils
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Utils {

  public static function durationtoString(Duration $duration): string {
    $item = [];
    if ($duration->h > 0) {
      $item[] = "{$duration->h} hrs";
    }
    if ($duration->i > 0) {
      $item[] = "{$duration->i} min";
    }
    if ($duration->s > 0) {
      $item[] = "{$duration->s} sec";
    }
    return \implode(' ', $item);
  }

}
