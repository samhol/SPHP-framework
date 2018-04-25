<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars;

use Sphp\DateTime\Date;

/**
 * Description of CalendarDateIterator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface TraversableCalendar extends \Traversable {

  public function setDate(CalendarDate $date): CalendarDate;

  public function setHoliday($date, string $name): Holiday;

  public function setBirthDay($date, string $name): BirthDay;

  public function mergeDate(CalendarDate $date): CalendarDate;

  public function mergeCalendar(TraversableCalendar $days);

  /**
   * 
   * @param Date $date
   * @etun CalendarDate
   */
  public function get($date): CalendarDate;

  /**
   * 
   * @param  CalendarDate|string|int $date
   * @return bool 
   */
  public function contains($date): bool;
}
