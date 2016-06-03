<?php

/**
 * DefaultEqualsTrait.php (UTF-8)
 * Copyright (c) 2008 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Objects;

/**
 * DefaultEqualsTrait implements the default equals method
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-19
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait EqualsTrait {

  /**
   * Determines whether the specified object is equal to the current object
   *
   * @param  mixed $object the object to compare with the current object
   * @return boolean true if the specified object is equal to the current 
   *         object; otherwise false
   */
  public function equals($object) {
    return $object == $this;
  }

}
