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

/**
 * Class ConstraintAggregate
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ConstraintsAggregate extends AbstractConstraintsAggregate {

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
    $not = new AllOf(...$c);
    $this->addConstraint($not);
    return $not;
  }

  /**
   * Sets constraints that are not true
   * 
   * @param  DateConstraint ... $c 
   * @return NoneOf
   */
  public function isNot(DateConstraint ... $c): NoneOf {
    $not = new NoneOf(...$c);
    $this->addConstraint($not);
    return $not;
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
