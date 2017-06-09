<?php

/**
 * MenuInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Html\ContentInterface;

/**
 * Defines a basic menu
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-03-11
 * @link    http://foundation.zurb.com/ Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface MenuInterface extends ContentInterface {

  /**
   * Appends a menu item object to the menu
   *
   * @param  MenuItemInterface $item
   * @return self for a fluent interface
   */
  public function append(MenuItemInterface $item);

  /**
   * Appends a {@link MenuLabel} text component to the menu
   *
   * @param  mixed|MenuLabel $text
   * @return self for a fluent interface
   */
  public function appendText($text);

  /**
   * Appends a ruler component to the menu
   *
   * @param  Ruler|null $r
   * @return self for a fluent interface
   */
  public function appendRuler(Ruler $r = null);
  /**
   * Creates and appends {@link MenuLink} link object to the list
   *
   * @param  string|URL $href the URL of the link
   * @param  mixed $content link content
   * @param  string $target the value of the target attribute
   * @return self for a fluent interface
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
   * @return self for a fluent interface
   * @see    self::nested() 
   */
  public function nested(bool $nested = true);

  /**
   * Switches menu orientation between vertical and horizontal
   *
   * @param  boolean $vertical true for vertical orientation and false for horizontal
   * @return self for a fluent interface
   */
  public function vertical(bool $vertical = true);

  /**
   * Sets or unsets the menu as active
   *
   * @param  boolean $active true for activation and false for deactivation
   * @return self for a fluent interface
   */
  public function setActive(bool $active = true);

  /**
   * Checks whether the menu is set as active or not
   *
   * @return boolean true if the menu is set as active, otherwise false
   */
  public function isActive(): bool;
}
