<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries;

/**
 * Defines basic featured for a Diary containing calendar logs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License 
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
interface DiaryInterface {

  /**
   * Returns an object containing logs for a single date
   * 
   * @param  DateInterface|DateTimeInteface|string|int|null $date raw date data
   * @return DiaryDate object containing logs for given single date
   */
  public function getDate($date): DiaryDateInterface;
}
