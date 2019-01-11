<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime;

use Traversable;
use Sphp\Stdlib\Datastructures\Arrayable;

/**
 * Defines a date period
 *
 * A date period allows iteration over a set of dates and times, recurring at 
 * regular intervals, over a given period.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface PeriodInterface extends Traversable, Arrayable {

  public function getStartDate(): DateTimeInterface;

  public function getEndDate(): DateTimeInterface;

  /**
   * Checks if the given date is in the range
   * 
   * @param  mixed $date the date to match
   * @return bool true if given datetime is in the period
   */
  public function containsDate($date): bool;

  /**
   * Checks if the given date is in the range
   * 
   * @param  mixed $date the date to match
   * @return bool true if given datetime is in the period
   */
  public function contains($date): bool;
}
