<?php

/**
 * MenuInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Html\ContentInterface;

/**
 * Defines a basic Foundation 6 menu interface
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-03-11
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface MenuInterface extends ContentInterface {

  /**
   * Appends a {@link MenuLabel} text component to the menu
   *
   * @param  mixed|MenuLabel $text
   * @return self for PHP Method Chaining
   */
  public function appendText($text);

  /**
   * Creates and appends {@link MenuLink} link object to the list
   *
   * @param  string|URL $href the URL of the link
   * @param  mixed $content link content
   * @param  string $target the value of the target attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function appendLink($href, $content = "", $target = "_self");

  /**
   * Adds/removes padding to the vertically oriented Menu
   * 
   * A nested vertically oriented Menu has extra padding on the inside.
   *
   * @param  boolean $nested true for nesting and false for unnesting
   * @return self for PHP Method Chaining
   * @see    self::nested() 
   */
  public function nested($nested = true);

  /**
   * Switches menu orientation between vertical and horizontal
   *
   * @param  boolean $vertical true for vertical orientation and false for horizontal
   * @return self for PHP Method Chaining
   */
  public function vertical($vertical = true);

  /**
   * Sets or unsets the menu as active
   *
   * @param  boolean $active true for activation and false for deactivation
   * @return self for PHP Method Chaining
   */
  public function setActive($active = true);

  /**
   * Checks whether the menu is set as active or not
   *
   * @return boolean true if the menu is set as active, otherwise false
   */
  public function isActive();
}
