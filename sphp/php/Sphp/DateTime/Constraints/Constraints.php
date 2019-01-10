<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Constraints;

use Sphp\Stdlib\Strings;
use Sphp\Exceptions\BadMethodCallException;

/**
 * Implements a collection of date Constraints
 * 
 * @method \Sphp\DateTime\Constraints\Constraints isAnnual(int $month, int $day) Adds an `Annual` constraint
 * @method \Sphp\DateTime\Constraints\Constraints isNotAnnual(int $month, int $day) Adds a not `Annual` constraint
 * @method \Sphp\DateTime\Constraints\Constraints isBetween(mixed $start = null, mixed $stop = null) Adds an `Between` constraint
 * @method \Sphp\DateTime\Constraints\Constraints isNotBetween(mixed $start = null, mixed $stop = null) Adds a not `Between` constraint
 * @method \Sphp\DateTime\Constraints\Constraints isAfter(mixed $date) Adds an `After` constraint
 * @method \Sphp\DateTime\Constraints\Constraints isNotAfter(mixed $date)  Adds a not `After` constraint
 * @method \Sphp\DateTime\Constraints\Constraints isBefore(mixed $date) Adds an `Before` constraint
 * @method \Sphp\DateTime\Constraints\Constraints isNotBefore(mixed $date)  Adds a not `Before` constraint
 * @method \Sphp\DateTime\Constraints\Constraints isOneOf(mixed ...$date) Adds an `OneOf` constraint
 * @method \Sphp\DateTime\Constraints\Constraints isNotOneOf(mixed ...$date)  Adds a not `OneOf` constraint
 * @method \Sphp\DateTime\Constraints\Constraints isWeekly(int... $weekday) Adds an `Weekly` constraint
 * @method \Sphp\DateTime\Constraints\Constraints isNotWeekly(int... $weekday) Adds a not `Weekly` constraint
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Constraints implements DateConstraint {

  /**
   * @var Constraint[] 
   */
  private $dateIs;

  /**
   * @var Constraint[] 
   */
  private $dateIsNot;

  /**
   * Constructor
   */
  public function __construct() {
    $this->dateIs = [];
    $this->dateIsNot = [];
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->dateIs, $this->dateIsNot);
  }

  /**
   * Magic `call` method invoking inaccessible methods in an object context
   * 
   * @param  string $name method name
   * @param  array $arguments
   * @return $this for a fluent interface
   * @throws BadMethodCallException if the call fails
   */
  public function __call(string $name, $arguments) {
    $class = Strings::trimLeft($name, 'is|isNot');
    try {
      $reflector = new \ReflectionClass(__NAMESPACE__ . '\\' . $class);
      $const = $reflector->newInstanceArgs($arguments);
    } catch (\ReflectionException $ex) {
      throw new BadMethodCallException("Invalid method '$name' call", $ex->getCode(), $ex);
    }
    if (Strings::startsWith($name, 'isNot')) {
      $this->dateIsNot($const);
    } else if (Strings::startsWith($name, 'is')) {
      $this->dateIs($const);
    } else {
      throw new BadMethodCallException("Method '$name' does not exist");
    }
    return $this;
  }

  public function isValid($date): bool {
    $is = true;
    $isNot = false;
    foreach ($this->dateIs as $constraint) {
      if (!$constraint->isValid($date)) {
        $is = false;
        break;
      }
    }
    if ($is) {
      foreach ($this->dateIsNot as $constraint) {
        if ($constraint->isValid($date)) {
          $isNot = true;
          break;
        }
      }
    }
    return $is && !$isNot;
  }

  /**
   * Sets a rule to include dates
   * 
   * @param  DateConstraint $c
   * @return $this for a fluent interface
   */
  public function dateIs(DateConstraint $c) {
    $this->dateIs[] = $c;
    return $this;
  }

  /**
   * Sets a rule to exclude dates
   * 
   * @param  DateConstraint $c 
   * @return $this for a fluent interface
   */
  public function dateIsNot(DateConstraint $c) {
    $this->dateIsNot[] = $c;
    return $this;
  }

}
