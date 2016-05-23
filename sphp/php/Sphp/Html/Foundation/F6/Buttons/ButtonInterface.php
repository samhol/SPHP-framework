<?php

/**
 * ButtonInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Buttons;

/**
 * Interface specifies the basic functionality of a Foundation styled button
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-11
 * @version 1.0.0
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/button.html# Foundation 6 Buttons
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ButtonInterface {

  /**
   * Sets the color style to default
   * 
   * @return self for PHP Method Chaining
   * @link   http://foundation.zurb.com/docs/components/buttons.html#button-colors Button Colors
   */
  public function defaultColor();

  /**
   * Sets the color to `'alert'` style
   * 
   * @return self for PHP Method Chaining
   * @link   http://foundation.zurb.com/docs/components/buttons.html#button-colors Button Colors
   */
  public function alertColor();

  /**
   * Sets the color to `'success'` style
   * 
   * @return self for PHP Method Chaining
   * @link   http://foundation.zurb.com/docs/components/buttons.html#button-colors Button Colors
   */
  public function successColor();

  /**
   * Sets the color to `'secondary'` style
   * 
   * @return self for PHP Method Chaining
   * @link   http://foundation.zurb.com/docs/components/buttons.html#button-colors Button Colors
   */
  public function secondaryColor();

  /**
   * Sets the color (a CSS class)
   * 
   * Predefined values of <var>$style</var> parameter:
   * 
   * * `null` unsets all special button styles (default)
   * * `'alert'` for alert/error buttons
   * * `'success'` for ok/success buttons
   * * `'info'` for information buttons
   * * `'secondary'` for alternatively styled buttons
   * * `'disabled'` for disabled buttons
   * 
   * @param  string|null $style one of the CSS class names defining button styles
   * @return self for PHP Method Chaining
   * @link   http://foundation.zurb.com/docs/components/buttons.html#button-colors Button Colors
   */
  public function setColor($style = null);

  /**
   * Sets the size of the button 
   * 
   * Build in values for <var>$size</var> parameter:
   * 
   * * `'tiny'` for tiny buttons
   * * `'small'` for small buttons
   * * `null` for medium buttons (default)
   * * `'large'` for large buttons
   * * `'extend'` for extended buttons (takes the full width of the container)
   * 
   * @param  string|null $size CSS class name defining button size. 
   *         `null` value corresponds to no explicit size definition.
   * @return self for PHP Method Chaining
   * @link   http://foundation.zurb.com/sites/docs/button.html#sizing Button Sizing
   */
  public function setSize($size);

  /**
   * Sets the button size as ´'tiny'´ 
   * 
   * @return self for PHP Method Chaining
   * @link   http://foundation.zurb.com/sites/docs/button.html#sizing Button Sizing
   */
  public function setTiny();

  /**
   * Sets the button size as ´'small'´ 
   * 
   * @return self for PHP Method Chaining
   * @link   http://foundation.zurb.com/sites/docs/button.html#sizing Button Sizing
   */
  public function setSmall();

  /**
   * Sets the button size to default
   * 
   *  Removes all specified size related CSS classes
   * 
   * @return self for PHP Method Chaining
   * @link   http://foundation.zurb.com/sites/docs/button.html#sizing Button Sizing
   */
  public function setDefaultSize();

  /**
   * Sets the button size as ´'large'´ 
   * 
   * @return self for PHP Method Chaining
   * @link   http://foundation.zurb.com/sites/docs/button.html#sizing Button Sizing
   */
  public function setLarge();

  /**
   * Sets the button size as ´'expand'´ 
   * 
   * @return self for PHP Method Chaining
   * @link   http://foundation.zurb.com/sites/docs/button.html#sizing Button Sizing
   */
  public function setExpanded();
}
