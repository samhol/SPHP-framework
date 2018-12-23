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
 * Defines properties for a datetime
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
interface DateTimeInterface extends DateInterface {

  /**
   * Returns the Unix timestamp
   * 
   * @return int the Unix timestamp
   */
  public function getTimestamp(): int;

  /**
   * Returns the number of hours
   * 
   * @return int the number of hours
   */
  public function getHours(): int;

  /**
   * Returns the number of minutes
   * 
   * @return int the number of minutes
   */
  public function getMinutes(): int;

  /**
   * Returns the number of seconds
   * 
   * @return int the number of seconds
   */
  public function getSeconds(): int;
}
