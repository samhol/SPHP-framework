<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Calendars\Diaries\Schedules;

use Sphp\DateTime\Time;
use Sphp\DateTime\Duration;
use Sphp\DateTime\Constraints\DateConstraint;
use Sphp\DateTime\Date;

/**
 * The BasicEvent class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class BasicEvent implements CalendarEvent {

  /**
   * @var string
   */
  private string $name;

  /**
   * @var Time
   */
  private Time $start;

  /**
   * @var Duration
   */
  private Duration $duration;

  /**
   * @var DateConstraint
   */
  private DateConstraint $constraint;

  /**
   * Constructs an instance
   * 
   * @param Time $start
   * @param Duration $duration
   * @param DateConstraint|null $constraint
   */
  public function __construct(string $event, Time $start, Duration $duration, ?DateConstraint $constraint = null) {
    $this->name = $event;
    $this->start = $start;
    $this->duration = $duration;
    if ($constraint === null) {
      $constraint = new \Sphp\DateTime\Constraints\Constraints();
    }
    $this->constraint = $constraint;
  }

  public function __destruct() {
    unset($this->start, $this->duration, $this->constraint);
  }
  public function getName(): string {
    return $this->name;
  }

  public function getStart(): Time {
    return $this->start;
  }
  
  public function getEnd($param) {
    
  }

  public function getDuration(): Duration {
    return $this->duration;
  }

  public function getConstraint(): DateConstraint {
    return $this->constraint;
  }


  public function dateMatchesWith(Date $date): bool {
    return $this->constraint->isValid($date);
  }

}
