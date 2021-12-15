<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Calendars\Diaries\Holidays;

use Sphp\DateTime\Constraints\Constraints;
use Sphp\DateTime\Constraints\Annual;
use Sphp\DateTime\Constraints\Before;
use Sphp\DateTime\Date;
use Sphp\DateTime\ImmutableDate;
use Sphp\DateTime\Interval;

/**
 * Implements a BirthDay log object for a Diary
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class BirthDay extends Holiday {

  /**
   * Date of birth 
   */
  private Date $dob;

  /**
   * Date of death 
   */
  private ?Date $dod;

  /**
   * Constructor
   * 
   * @param Date $dob the date of birth
   * @param string $name
   * @param Date|null $dod optional date of death
   */
  public function __construct(Date $dob, string $name, ?Date $dod = null) {
    $this->dob = $dob;
    $this->dod = $dod;
    $constraints = new Constraints();
    $constraints->is(new Annual($this->dob->getMonth(), $this->dob->getMonthDay()));
    $constraints->isNot(new Before($this->dob));
    parent::__construct($constraints, $name);
  }

  public function __destruct() {
    unset($this->dob, $this->dod);
    parent::__destruct();
  }

  /**
   * Returns the date of birth
   * 
   * @return Date the date of birth
   */
  public function getDateOfBirth(): Date {
    return $this->dob;
  }

  /**
   * Returns the date of death
   * 
   * @return Date|null the date of death
   */
  public function getDateOfDeath(): ?Date {
    return $this->dod;
  }

  public function isDead(): bool {
    return $this->dod !== null;
  }

  public function getAge($toDate = null): Interval {
    if ($toDate === null) {
      $toDate = ImmutableDate::now();
    }
    if ($this->isDead() && $this->getDateOfDeath()->compareDateTo($toDate) < 0) {
      $toDate = $this->getDateOfDeath();
    } else {
      $toDate = ImmutableDate::from($toDate);
    }
    return $this->getDateOfBirth()->diff($toDate);
  }

}
