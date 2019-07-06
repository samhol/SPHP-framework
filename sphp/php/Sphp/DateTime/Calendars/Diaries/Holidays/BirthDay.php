<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries\Holidays;

use Sphp\DateTime\Constraints\Constraints;
use Sphp\DateTime\Constraints\Annual;
use Sphp\DateTime\Constraints\Before;
use Sphp\DateTime\DateInterface;
use Sphp\Data\Person;
use Sphp\Exceptions\InvalidArgumentException;

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
   * @var Person
   */
  private $person;

  /**
   * Constructor
   * 
   * @param Person $person
   */
  public function __construct(Person $person) {
    $this->person = $person;
    if ($this->person->getDateOfBirth() === null) {
      throw new InvalidArgumentException('Person must have date of birth');
    }
    $constraints = new Constraints();
    $constraints->dateIs(new Annual($this->person->getDateOfBirth()->getMonth(), $this->person->getDateOfBirth()->getMonthDay()));
    $constraints->dateIsNot(new Before($this->person->getDateOfBirth()->format('Y-m-d')));
    parent::__construct($constraints, $person->getFname());

    //$this->dateOfDeath = $dateOfDeath;
  }

  public function __destruct() {
    unset($this->person);
    parent::__destruct();
  }

  public function getDate(): DateInterface {
    return $this->person->getDateOfBirth();
  }

  public function getPerson(): Person {
    return $this->person;
  }

}
