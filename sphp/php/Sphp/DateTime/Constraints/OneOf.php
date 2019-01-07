<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Constraints;

use Sphp\DateTime\DateTimes;

/**
 * Implements a group of dates constraint
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class OneOf implements DateConstraint {

  /**
   * @var string[]
   */
  private $dates;

  /**
   * Constructor
   * 
   * @param  mixed ...$date
   */
  public function __construct(... $date) {
    $this->dates = [];
    foreach ($date as $d) {
      $this->addDate($d);
    }
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->dates);
  }

  /**
   * Adds new allowed dates
   * 
   * @param  mixed ...$date
   * @return $this for a fluent interface
   */
  public function addDates(... $date) {
    foreach ($date as $d) {
      $this->addDate($d);
    }
    return $this;
  }

  /**
   * 
   * @param  mixed $date
   * @return $this for a fluent interface
   */
  public function addDate($date) {
    $key = DateTimes::parseDateString($date);
    if (!array_key_exists($key, $this->dates)) {
      $this->dates[$key] = $date;
    }
    return $this;
  }

  public function isValid($date): bool {
    $key = DateTimes::parseDateString($date);
    return array_key_exists($key, $this->dates);
  }

}
