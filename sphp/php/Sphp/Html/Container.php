<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

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
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
interface Container extends TraversableContent, ArrayAccess {

  /**
   * Appends a new value as the last element
   *
   * @param  mixed $value element
   * @return $this for a fluent interface
   */
  public function append($value);

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
   * Replaces the content
   *
   * @param  mixed $content new content
   * @return $this for a fluent interface
   */
  public function resetContent($content);

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
