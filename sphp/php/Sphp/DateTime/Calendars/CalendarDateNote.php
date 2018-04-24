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
 * Defines CalendarDateNote
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2018-04-24
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface CalendarDateNote {

  public function getDate(): Date;

  public function __toString(): string;
}
