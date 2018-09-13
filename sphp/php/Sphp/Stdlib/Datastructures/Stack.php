<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Datastructures;

use Sphp\Exceptions\UnderflowException;

/**
 * Defines properties of a last-in-first-out (LIFO) stack
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface Stack {

  /**
   * Pushes an item onto the top of the stack
   *
   * @param  mixed $value the item to be pushed
   * @return $this for a fluent interface
   */
  public function push($value);

  /**
   * Removes the item at the top of the stack and returns that item as the value
   *
   * @return mixed the top-most element
   * @throws UnderflowException when the data-structure is empty
   */
  public function pop();

  /**
   * Observes the top-most element without removing it from the stack
   *
   * @return mixed the top-most element
   * @throws UnderflowException when the data-structure is empty
   */
  public function peek();

  /**
   * Determine if the stack is empty or not
   *
   * @return boolean true if the stack is empty, false otherwise
   */
  public function isEmpty();
}
