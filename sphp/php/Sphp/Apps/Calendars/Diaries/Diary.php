<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Calendars\Diaries;
use Sphp\DateTime\Date;
/**
 * Defines basic featured for a Diary containing calendar logs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License 
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
interface Diary {

  /**
   * Returns an object containing logs for a single date
   * 
   * @param  Date $date raw date data
   * @return DiaryDate object containing logs for given single date
   */
  public function getDate(Date $date): DiaryDateInterface;
}
