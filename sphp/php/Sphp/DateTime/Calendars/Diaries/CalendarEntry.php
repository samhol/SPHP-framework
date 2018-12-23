<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries;

use Sphp\DateTime\DateInterface;

/**
 * Defines a Calendar Diary log
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
interface CalendarEntry {

  /**
   * Checks if the given date matches with the log's date
   * 
   * @param  DateInterface|\DateTimeInteface|string|int|null $date the date to match
   * @return bool true if the given date matches and false otherwise
   */
  public function dateMatchesWith($date): bool;

  /**
   * Returns the string representation of the object
   * 
   * @return string the string representation of the object
   */
  public function __toString(): string;
}
