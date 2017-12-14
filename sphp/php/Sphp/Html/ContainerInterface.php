<?php

/**
 * ContainerInterface.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Sphp\Stdlib\Datastructures\Arrayable;
use ArrayAccess;

/**
 * Defines the properties required from a traversable HTML component container with
 *
 * This object supports for example these properties:
 *
 * 1. Any extending class act as a container for other HTML components and text.
 * 2. The type of the content in such container depends solely on the container's
 *    purpose of use.
 * 3. Any extending class can be used in **PHP**'s `foreach` construct.
 * 4. Any extending class can be used with the **PHP**'s `count()` function.
 * 5. All container's content data can be reached by PHP's `ArrayAccess`
 *    notation.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ContainerInterface extends TraversableContent, Arrayable, ArrayAccess {

  /**
   * Appends a new value as the last element
   *
   * @param  mixed,... $value element
   * @return $this for a fluent interface
   */
  public function append(...$value);

  /**
   * Prepends a new value as the first element
   *
   * * The numeric keys of the content will be renumbered starting from zero
   *   and the index of the prepended value is 'int(0)'
   *
   * @param  mixed $value the value being prepended
   * @return $this for a fluent interface
   */
  public function prepend($value);

  /**
   * Sets the content of the component
   *
   * * The numeric keys of the content will be renumbered starting from zero
   *   and the index of the prepended value is 'int(0)'
   *
   * @param  mixed $content the new content
   * @return $this for a fluent interface
   */
  public function setContent($content);

  /**
   * Clears the contents
   *
   * @return $this for a fluent interface
   */
  public function clear();

  /**
   * Checks if a value exists in an container
   *
   * @param  mixed $value mixed content to check for
   * @return boolean `true` on success or `false` on failure
   */
  public function exists($value): bool;
}
