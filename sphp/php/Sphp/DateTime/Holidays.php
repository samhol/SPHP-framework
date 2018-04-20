<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime;
use DateTime;
use DateTimeInterface;
use DateTimeImmutable;
/**
 * Description of Holidays
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Holidays {

  private $data;

  public function __construct(array $data = []) {
    $this->data = $data;
  }

  /**
   * 
   * @param Date $date
   * @return bool 
   */
  public function hasHoliday(Date $date): bool {
    
  }

  /**
   * 
   * @param Date $date
   */
  public function get(Date $date): array {
    $month = $date->getMonth();
    $day = $date->getMonthDay();
    if (array_key_exists($month, $this->data['y'])) {
      if (array_key_exists($day, $this->data['y'][$month])) {
        return $this->data['y'][$month][$day];
      }
    }
    return [];
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
