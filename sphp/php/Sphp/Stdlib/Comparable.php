<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib;

use Sphp\Exceptions\InvalidArgumentException;

/**
 * Classes that implements this interface can be compared to other similar objects.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface Comparable {

  /**
   * Compares this object with the specified object for order
   * 
   * @postcondition RESULT === 1: $other < $this
   * @postcondition RESULT === -1: $other > $this
   * @postcondition RESULT === 0: $other == $this
   * 
   * @param  mixed $other the object to be compared
   * @return int a negative integer, zero, or a positive integer as this object is less than, equal to,
   *             or greater than the specified object
   * @throws InvalidArgumentException if the type of the `$other` prevents it from being compared to this object.
   */
  public function compareTo($other): int;
}
