<?php

/**
 * StackInterface.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib\Datastructures;

/**
 * Defines properties of a last-in-first-out (LIFO) stack
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-06-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface StackInterface {

  /**
   * Pushes an item onto the top of the stack
   *
   * @param  mixed $value the item to be pushed
   * @return self for a fluent interface
   */
  public function push($value);

  /**
   * Removes the item at the top of the stack and returns that item as the value
   *
   * @return mixed the top-most element
   * @throws \Sphp\Exceptions\RuntimeException when the data-structure is empty
   */
  public function pop();

  /**
   * Observes the top-most element without removing it from the stack
   *
   * @return mixed the top-most element
   * @throws \Sphp\Exceptions\RuntimeException when the data-structure is empty
   */
  public function peek();

  /**
   * Determine if the stack is empty or not
   *
   * @return boolean true if the stack is empty, false otherwise
   */
  public function isEmpty();
}
