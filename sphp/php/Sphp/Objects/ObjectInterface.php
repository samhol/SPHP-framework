<?php

/**
 * ObjectInterface.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Objects;

/**
 * Interface describes common features for all Objects.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-09-11
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ObjectInterface {

  /**
   * Returns the string representation of the object
   *
   * @return string the string representation of the object
   */
  public function __toString();

  /**
   * Determines whether the specified object is equal to the current object
   *
   * @param  mixed $object the object to compare with the current object
   * @return boolean true if the specified object is equal to the current
   *         object; otherwise false
   */
  public function equals($object);
}
