<?php

/**
 * ButtonInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Buttons;

use Sphp\Html\CssClassifiableContent;
use Sphp\Html\Foundation\Sites\Core\Colourable;

/**
 * Defines the basic functionality of a Foundation styled button
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/button.html Foundation Buttons
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ButtonInterface extends CssClassifiableContent, Colourable {

  /**
   * Sets the size of the button 
   * 
   * Build in values for <var>$size</var> parameter:
   * 
   * * `'tiny'` for tiny buttons
   * * `'small'` for small buttons
   * * `'medium'` for medium buttons (default)
   * * `'large'` for large buttons
   * * `'extend'` for extended buttons (takes the full width of the container)
   * 
   * @param  string|null $size CSS class name defining button size. 
   *         `null` value corresponds to no explicit size definition.
   * @return $this for a fluent interface
   * @link   http://foundation.zurb.com/sites/docs/button.html#sizing Button Sizing
   */
  public function setSize(string $size);

  /**
   * Sets the button size to default
   * 
   *  Removes all specified size related CSS classes
   * 
   * @return $this for a fluent interface
   * @link   http://foundation.zurb.com/sites/docs/button.html#sizing Button Sizing
   */
  public function setExtended(bool $extended = true);

  /**
   * Determines whether the button style is `hollow` or not
   * 
   * This is purely a visual style
   * 
   * @param boolean $hollow true for `hollow` style, otherwise false
   * @return $this for a fluent interface
   */
  public function isHollow(bool $hollow = true);

  /**
   * Determines whether the button style is `disabled` or not
   * 
   * This is purely a visual style
   *
   * @param  boolean $disabled true for `disabled` style, otherwise false
   * @return $this for a fluent interface
   * @link   http://foundation.zurb.com/sites/docs/button.html#dropdown-arrows
   */
  public function disable(bool $disabled = true);

  /**
   * Determines whether the button style is `dropdown` or not
   * 
   * This is purely a visual style
   * 
   * @param boolean $dropdown true for `dropdown` style, otherwise false
   * @return $this for a fluent interface
   */
  public function isDropdown(bool $dropdown = true);
}
