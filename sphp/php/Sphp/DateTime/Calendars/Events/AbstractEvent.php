<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Events;

use Sphp\DateTime\DateInterface;
use Sphp\DateTime\Calendars\Events\Constraints\Constraint;

/**
 * Description of AbstractEvent
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractEvent implements Event {

  /**
   * @var Constraint 
   */
  private $constraint;

  /**
   * Constructor
   *  
   * @param Constraint $constraint
   */
  public function __construct(Constraint $constraint) {
    $this->constraint = $constraint;
  }

  public function __destruct() {
    unset($this->constraint);
  }

  public function dateMatchesWith($date): bool {
    return $this->constraint->isValidDate($date);
  }

}
