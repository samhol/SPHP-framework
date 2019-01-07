<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Constraints;

use Sphp\DateTime\Date;

/**
 * Implements an unique date constraint
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Unique implements DateConstraint {

  /**
   * @var Date 
   */
  private $date;

  /**
   * Constructor
   * 
   * @param mixed $date the date of the holiday
   */
  public function __construct($date) {
    $this->date = Date::from($date);
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->date);
  }

  public function isValid($date): bool {
    return $this->date->dateEqualsTo($date);
  }

}
