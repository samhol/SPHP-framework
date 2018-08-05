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
 * Defines a date interval
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface IntervalInterface {

  /**
   * Returns the interval as seconds
   * 
   * @return float the interval as seconds
   */
  public function toSeconds(): float;

  /**
   * Returns the interval in minutes
   * 
   * @return float the interval in minutes
   */
  public function toMinutes(): float;

  /**
   * Returns the interval in minutes
   * 
   * @return float the interval in minutes
   */
  public function toHours(): float;
}
