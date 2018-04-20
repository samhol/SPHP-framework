<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime;

/**
 * Description of FathersDay
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class FathersDay extends Holiday {

  public function __construct(int $year = null) {
    if ($year === null) {
      $year = (int) date('Y');
    }
    $f = Date::createFromString("$year-11-1");
    if ($f->getWeekDay() === 6) {
      $f = $f->jump(7);
    } else {
      $f = $f->modify('next Sunday')->jump(7);
    }
    parent::__construct($f, "Father's Day");
  }

}
