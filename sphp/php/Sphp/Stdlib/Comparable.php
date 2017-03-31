<?php

/**
 * Comparable.php (UTF-8)
 * Copyright (c) 2008 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib;

use Sphp\Exceptions\InvalidArgumentException;

/**
 * Classes that implements this interface can be compared to other similar objects.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2008-03-10
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
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
  public function compareTo($other);
}
