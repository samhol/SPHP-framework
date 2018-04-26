<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Notes;

use Sphp\DateTime\DateInterface;

/**
 * Defines CalendarDateNote
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2018-04-24
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface Note {

  /**
   * 
   * @return bool
   */
  public function dateMatchesWith(DateInterface $date): bool;

  public function noteAsString(): string;

  public function __toString(): string;
}
