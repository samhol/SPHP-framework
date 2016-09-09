<?php

/**
 * CloneNotSupportedTrait.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core;

/**
 * Class CloneNotSupportedTrait
 * 
 * A class uses the {@see CloneNotSupportedTrait} to indicate to the magic
 * `__clone` method of a class that it is **illegal** for that method to make a
 * field-for-field copy of instances of that class.
 *
 * Invoking the magic `__clone` method on an instance that uses the {@see
 * CloneNotSupportedTrait} results in the exception {@see
 * CloneNotSupportedException} being thrown.
 *
 * @see   CloneNotSupportedException
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-19
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait CloneNotSupportedTrait {

  /**
   * Throws a {@see CloneNotSupportedException}.
   *
   * @throws CloneNotSupportedException Always.
   */
  final public function __clone() {
    throw new CloneNotSupportedException;
  }

}
