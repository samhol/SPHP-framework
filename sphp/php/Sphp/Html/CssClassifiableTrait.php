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
 * Trait implements functionality of the {@link CssClassifiableContent}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
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
   * @param  string|string[],... $cssClasses CSS class names to add
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_global_class.asp CSS class attribute
   */
  public function addCssClass(...$cssClasses) {
    $this->cssClasses()->add($cssClasses);
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
   * @param  string|string[],... $cssClasses CSS class names to remove
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_global_class.asp class attribute
   */
  public function removeCssClass(...$cssClasses) {
    $this->cssClasses()->remove($cssClasses);
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
   * @param  string|string[],... $cssClasses CSS class names to search for
   * @return boolean true if the given CSS class names exists
   * @link   http://www.w3schools.com/tags/att_global_class.asp class attribute
   */
  public function hasCssClass(...$cssClasses): bool {
    return $this->cssClasses()->contains($cssClasses);
  }

}
