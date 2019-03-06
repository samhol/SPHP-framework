<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Html\Component;

/**
 * Defines a basic menu
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
interface Menu extends Component {

  const VERTICAL = 'vertical';
  const HORIZONTAL = 'horizontal';
  
  const ACCORDION = 'accordion';
  const DRILLDOWN = 'drilldown';
  const DROPDOWN = 'dropdown';
  /**
   * Appends a menu item object to the menu
   *
   * @param  MenuItem $item
   * @return $this for a fluent interface
   */
  public function append(MenuItem $item): MenuItem;

  /**
   * Appends a label text component to the menu
   *
   * @param  mixed|MenuLabel $text
   * @return MenuLabel appended instance
   */
  public function appendText($text): MenuLabel;

  /**
   * Appends a ruler component to the menu
   *
   * @param  Ruler|null $r
   * @return Ruler appended instance
   */
  public function appendRuler(Ruler $r = null): Ruler;

  /**
   * Creates and appends link object to the list
   *
   * @param  string $href the URL of the link
   * @param  mixed $content link content
   * @param  string $target the value of the target attribute
   * @return MenuLink appended instance
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function appendLink(string $href, string $content = "", string $target = "_self"): MenuLink;

  /**
   * Adds/removes padding to the vertically oriented Menu
   * 
   * A nested vertically oriented Menu has extra padding on the inside.
   *
   * @param  boolean $nested true for nesting and false for unnesting
   * @return $this for a fluent interface
   * @see    self::nested() 
   */
  public function nested(bool $nested = true);

  /**
   * Switches menu orientation between vertical and horizontal
   *
   * @param  boolean $vertical true for vertical orientation and false for horizontal
   * @return $this for a fluent interface
   */
  public function setVertical(bool $vertical = true);

  /**
   * Checks the orientation of the menu
   *
   * @return boolean true if the menu is vertical, otherwise false
   */
  public function isVertical(): bool;
  /**
   * Sets or unsets the menu as active
   *
   * @param  boolean $active true for activation and false for deactivation
   * @return $this for a fluent interface
   */
  public function setActive(bool $active = true);

  /**
   * Checks whether the menu is set as active or not
   *
   * @return boolean true if the menu is set as active, otherwise false
   */
  public function isActive(): bool;
}
