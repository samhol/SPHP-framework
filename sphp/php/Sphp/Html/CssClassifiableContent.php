<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use Sphp\Html\Attributes\ClassAttribute;

/**
 * Defines the basic functionality of a HTML content having CSS classes as attributes
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
interface CssClassifiableContent extends Content {

  /**
   * Returns the class attribute object
   * 
   * @return ClassAttribute the class attribute object
   */
  public function cssClasses(): ClassAttribute;

  /**
   * Adds the specified CSS class names
   *
   * **Important:** Parameter <var>$cssClasses</var> restrictions and rules
   * 
   * 1. A string parameter can contain multiple space separated CSS class names
   * 2. An array parameter can contain only one CSS class name per value
   * 3. Duplicate CSS class names are not stored
   *
   * @param  string|string[],... $cssClasses CSS class names to add
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_global_class.asp CSS class attribute
   */
  public function addCssClass(...$cssClasses);

  /**
   * Removes given CSS class names
   *
   * **Important:** Parameter <var>$cssClasses</var> restrictions and rules
   *
   * 1. A string parameter can contain multiple comma separated CSS class names
   * 2. An array parameter can contain only one CSS class name per value
   *
   * @param  string|string[],... $cssClasses CSS class names to remove
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_global_class.asp class attribute
   */
  public function removeCssClass(...$cssClasses);

  /**
   * Determines whether the given CSS class names are stored into the manager
   *
   * **Important:** Parameter <var>$cssClasses</var> restrictions and rules
   * 
   * 1. A string parameter can contain multiple comma separated CSS class names
   * 2. An array parameter can contain only one CSS class name per value
   *
   * @param  string|string[],... $cssClasses CSS class names to search for
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_global_class.asp class attribute
   */
  public function hasCssClass(...$cssClasses): bool;
}
