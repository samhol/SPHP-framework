<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Constraints;

use Sphp\DateTime\Date;
use Sphp\Stdlib\Arrays;

/**
 * Implements a weekly date constraint
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Weekly implements DateConstraint {

  /**
   * @var int
   */
  private $weekdays;

  /**
   * Constructor
   * 
   * @param int ...$weekday
   */
  public function __construct(... $weekday) {
    $this->weekdays = Arrays::flatten($weekday);
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->weekdays);
  }

  public function isValid($date): bool {
    return in_array(Date::from($date)->getWeekDay(), $this->weekdays, true);
  }

}
