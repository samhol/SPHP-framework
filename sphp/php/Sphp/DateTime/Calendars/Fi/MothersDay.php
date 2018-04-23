<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTimeCalendars\Fi;

use Sphp\DateTime\Holidays\Holiday;
use Sphp\DateTime\Date;

/**
 * Description of FathersDay
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class MothersDay extends Holiday {

  public function __construct(int $year = null) {
    if ($year === null) {
      $year = (int) date('Y');
    }
    $f = Date::fromString("$year-5-1");
    if ($f->getWeekDay() === 6) {
      $f = $f->jump(7);
    } else {
      $f = $f->modify('next Sunday')->jump(7);
    }
    parent::__construct($f, "Mothers's Day");
  }

}
