<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Calendars\Diaries\Holidays;

use Sphp\Apps\Calendars\Diaries\Log;

/**
 * Defines a holiday log object for a Diary
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface HolidayInterface extends Log {

  /**
   * Returns the name of the holiday
   * 
   * @return string the name of the holiday
   */
  public function getName(): string;

  /**
   * Checks if holiday is a Flag day
   * 
   * @return bool true if holiday is a flag day, false otherwise
   */
  public function isFlagDay(): bool;

  /**
   * Checks if holiday is a national holiday
   * 
   * @return bool true if holiday is a national holiday, false otherwise
   */
  public function isNationalHoliday(): bool;
}
