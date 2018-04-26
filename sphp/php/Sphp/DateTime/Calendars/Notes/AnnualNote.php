<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Notes;

/**
 * Defines CalendarDateNote
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface AnnualNote extends Note {

  /**
   * Returns the number of the month
   * 
   * @return int the number of the month
   */
  public function getMonth(): int;

  /**
   * Returns the day of the month
   * 
   * @return int the day of the month
   */
  public function getMonthDay(): int;
}
