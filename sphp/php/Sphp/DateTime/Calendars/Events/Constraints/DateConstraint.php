<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Events\Constraints;

use Sphp\DateTime\DateInterface;

/**
 * Defines a constraint for Calendar Dates
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
interface DateConstraint {

  /**
   * Checks if the given date matches with the rule
   * 
   * @param  DateInterface|\DateTimeInteface|string|int|null $date the date to match
   * @return bool true if the given date matches and false otherwise
   */
  public function isValidDate($date): bool;
}
