<?php

/**
 * CssClassifiedComponent.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Sphp\Html\Attributes\ClassAttribute;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;

/**
 * Defines the basic functionality of any HTML component
 *
 * This models an actual HTML component and supports HTML attribute manipulation.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface CssClassifiedComponent extends ContentInterface {

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
   * @param  string|string[] $cssClasses CSS class names to add
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_global_class.asp CSS class attribute
   */
  public function addCssClass($cssClasses);

  /**
   * Removes given CSS class names
   *
   * **Important:** Parameter <var>$cssClasses</var> restrictions and rules
   *
   * 1. A string parameter can contain multiple comma separated CSS class names
   * 2. An array parameter can contain only one CSS class name per value
   *
   * @param  string|string[] $cssClasses CSS class names to remove
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_global_class.asp class attribute
   */
  public function removeCssClass($cssClasses);

  /**
   * Determines whether the given CSS class names are stored into the manager
   *
   * **Important:** Parameter <var>$cssClasses</var> restrictions and rules
   * 
   * 1. A string parameter can contain multiple comma separated CSS class names
   * 2. An array parameter can contain only one CSS class name per value
   *
   * @param  string|string[] $cssClasses CSS class names to search for
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_global_class.asp class attribute
   */
  public function hasCssClass($cssClasses): bool;
}


