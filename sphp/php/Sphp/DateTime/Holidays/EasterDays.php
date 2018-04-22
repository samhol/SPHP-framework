<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Holidays;

use DateTime;
use Sphp\DateTime\Date;
use Sphp\DateTime\SpecialDays;
/**
 * Description of EasterDays
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class EasterDays extends SpecialDays {

  private $year;

  public function __construct(int $year = null) {
    if ($year === null) {
      $year = (int) date('Y');
    }
    parent::__construct();
    $this->year = $year;
    $this->parseDays();
  }

  protected function parseDays() {
    $this->add(new Holiday(static::getMaundyThursday($this->year), 'Maundy Thursday'));
    $this->add(new Holiday(static::getGoodFriday($this->year), 'Good Friday'));
    $this->add(new Holiday(static::getEasterSunday($this->year), 'Easter Sunday'));
    $this->add(new Holiday(static::getEasterMonday($this->year), 'Easter Monday'));
    $this->add(new Holiday(static::getAscensionDay($this->year), 'Ascension Day'));
  }

  /**
   * 
   * @param  int $year optional year (uses current if omitted) 
   * @return Date new date object
   */
  public static function getMaundyThursday(int $year = null): Date {
    return static::getEasterSunday($year)->jump(-4);
  }

  /**
   * 
   * @param  int $year optional year (uses current if omitted) 
   * @return Date new date object
   */
  public static function getGoodFriday(int $year = null): Date {
    return static::getEasterSunday($year)->jump(-2);
  }

  /**
   * 
   * @param  int $year optional year (uses current if omitted) 
   * @return Date new date object
   */
  public static function getEasterSunday(int $year = null): Date {
    if ($year === null) {
      $year = (int) date('Y');
    }
    return Date::fromTimestamp(easter_date());
  }

  /**
   * 
   * @param  int $year optional year (uses current if omitted) 
   * @return Date new date object
   */
  public static function getEasterMonday(int $year = null): Date {
    return static::getEasterSunday($year)->jump(1);
  }

  /**
   * 
   * @param  int $year optional year (uses current if omitted) 
   * @return Date new date object
   */
  public static function getAscensionDay(int $year = null): Date {
    return static::getEasterSunday($year)->jump(41);
  }

}
