<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Constraints;

use Sphp\DateTime\DateTimes;
use Sphp\DateTime\Date;

/**
 * Implements a group of dates constraint
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class AnyOfDates implements DateConstraint {

  /**
   * @var string[]
   */
  private array $dates;

  /**
   * Constructor
   * 
   * @param  mixed ...$date
   */
  public function __construct(... $date) {
    $this->dates = [];
    foreach ($date as $d) {
      $this->dates[] = DateTimes::parseDateString($d);
    }
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->dates);
  }

  public function isValid(Date $date): bool {
    return in_array(DateTimes::parseDateString($date), $this->dates);
  }

}
