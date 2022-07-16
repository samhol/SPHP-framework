<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Constraints;

use Sphp\DateTime\Date;
use Sphp\Stdlib\Strings;

/**
 * Class ConstraintAggregate
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Constraints extends AbstractConstraintsAggregate {

  /**
   * @var NoneOf
   */
  private $isNot;

  /**
   * @var AllOf
   */
  private $is;

  /**
   * Magic `call` method invoking inaccessible methods in an object context
   * 
   * @param  string $name method name
   * @param  array $arguments
   * @return DateConstraint
   * @throws BadMethodCallException if the method does not exist
   * @throws InvalidArgumentException if the method call has invalid arguments
   */
  public function __call(string $name, array $arguments): DateConstraint {
    $key = strtolower(str_replace('not', '', $name));
    $constraint = Factory::instance()->$key(...$arguments);
    if (str_starts_with($name, 'not')) {
      $this->isNot($constraint);
    } else {
      $this->is($constraint);
    }
    return $this;
  }

  public function isValid(Date $date): bool {
    $valid = true;
    if (!$this->isEmpty()) {
      foreach ($this as $constraint) {
        if (!$constraint->isValid($date)) {
          $valid = false;
          break;
        }
      }
    }
    return $valid;
  }

  /**
   * Sets constraints that must be true
   * 
   * @param  DateConstraint ... $c 
   * @return AllOf
   */
  public function is(DateConstraint ... $c): AllOf {
    if ($this->is === null) {
      $this->is = new AllOf(...$c);
      $this->addConstraint($this->is);
    } else {
      $this->is->addConstraints(...$c);
    }
    return $this->is;
  }

  /**
   * Sets constraints that should evaluate as false
   * 
   * @param  DateConstraint ... $c 
   * @return NoneOf
   */
  public function isNot(DateConstraint ... $c): NoneOf {
    if ($this->isNot === null) {
      $this->isNot = new NoneOf(...$c);
      $this->addConstraint($this->isNot);
    } else {
      $this->isNot->addConstraints(...$c);
    }
    return $this->isNot;
  }

  /**
   * Sets constraints that are not true
   * 
   * @param  DateConstraint ... $c 
   * @return AnyOf
   */
  public function isAnyOf(DateConstraint ... $c): AnyOf {
    $not = new AnyOf(...$c);
    $this->addConstraint($not);
    return $not;
  }

}
