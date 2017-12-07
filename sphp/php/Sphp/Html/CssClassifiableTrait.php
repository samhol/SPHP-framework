<?php

/**
 * IdentifiableComponentTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Sphp\Html\Attributes\ClassAttribute;

/**
 * Trait implements functionality of the {@link ComponentInterface} and {@link IdentifiableInterface}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait CssClassifiableTrait {

  /**
   * Returns the class attribute object
   *
   * @return ClassAttribute the class attribute object
   */
  abstract public function cssClasses(): ClassAttribute;

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
  public function addCssClass(...$cssClasses) {
    $this->cssClasses()->add(func_get_args());
    return $this;
  }

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
  public function removeCssClass(...$cssClasses) {
    $this->cssClasses()->remove(func_get_args());
    return $this;
  }

  /**
   * Determines whether the given CSS class names exists
   *
   * **Important:** Parameter <var>$cssClasses</var> restrictions and rules
   *
   * 1. A string parameter can contain multiple comma separated CSS class names
   * 2. An array parameter can contain only one CSS class name per value
   *
   * @param  string|string[] $cssClasses CSS class names to search for
   * @return boolean true if the given CSS class names exists
   * @link   http://www.w3schools.com/tags/att_global_class.asp class attribute
   */
  public function hasCssClass(...$cssClasses): bool {
    return $this->cssClasses()->contains(func_get_args());
  }

}