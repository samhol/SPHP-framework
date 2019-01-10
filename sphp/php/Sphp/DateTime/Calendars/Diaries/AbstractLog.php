<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries;

use Sphp\DateTime\Constraints\DateConstraint;
use Sphp\DateTime\Constraints\Constraints;

/**
 * Abstract implementation of a Diary log
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class AbstractLog implements CalendarEntry {

  /**
   * @var Constraint 
   */
  private $constraint;

  /**
   * Constructor
   *  
   * @param Constraint $constraint
   */
  public function __construct(DateConstraint $constraint = null) {
    $this->constraint = new Constraints();
    if ($constraint !== null) {
      $this->constraint->dateIs($constraint);
    }
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->constraint);
  }

  public function dateMatchesWith($date): bool {
    return $this->constraint->isValid($date);
  }

  public function dateRule(): Constraints {
    return $this->constraint;
  }

}
