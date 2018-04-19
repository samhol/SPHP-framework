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
 * Description of EasterDays
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class EasterDays {

  private $year;

  public function __construct(int $year = null) {
    if ($year === null) {
      $year = (int) date('Y');
    }
    $this->year = $year;
  }

  public static function getEasterSunday(int $year = null): DateTimeImmutable {
    if ($year === null) {
      $year = (int) date('Y');
    }
    return (new DateTimeImmutable())->setTimestamp(easter_date($year));
  }

  public static function getEasterMonday(int $year = null): DateTimeImmutable {
    return (new DateTimeImmutable())->setTimestamp(easter_date());
  }

}
