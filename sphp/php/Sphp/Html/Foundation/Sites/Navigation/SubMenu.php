<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Navigation\Hyperlink;

/**
 * Implements a Foundation navigation submenu
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/ Foundation for Sites
 * @link    http://foundation.zurb.com/sites/docs/menu.html Foundation menus
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class SubMenu extends AbstractComponent implements MenuItem, MenuInterface {

  /**
   * The root component
   *
   * @var Hyperlink
   */
  private $rootlink;

  /**
   * @var Menu
   */
  private $menu;

  /**
   * Constructor
   *
   * @param null|string|Hyperlink $root root content
   * @param null|Menu $menu
   */
  public function __construct($root = null, AbstractMenu $menu = NULL) {
    if ($menu === null) {
      $this->menu = new Menu();
    }
    parent::__construct('li');
    $this->setRoot($root);
    $this->cssClasses()->add('is-dropdown-submenu-parent');
  }

  /**
   * Sets the root component of the menu
   *
   * @param string|Hyperlink $root root content
   * @return $this for a fluent interface
   */
  public function setRoot($root) {
    if ($root instanceof Hyperlink) {
      $this->rootlink = $root;
    } else {
      $this->rootlink = new Hyperlink('#', $root);
    }
    return $this;
  }

  /**
   * 
   * @return Menu
   */
  public function getMenu() {
    return $this->menu;
  }

  /**
   * Appends a menu item object to the menu
   *
   * @param  MenuItem $item
   * @return $this for a fluent interface
   */
  public function append(MenuItem $item) {
    if ($item instanceof SubMenu) {
      $item->vertical($this->isVertical());
    }
    $this->menu->append($item);
    if ($item instanceof MenuLink && $item->isActive()) {
      $this->setActive(true);
    }
    return $this;
  }

  public function appendLink(string $href, string $content = '', string $target = '_self'): MenuLink {
    $menuLink = new MenuLink($href, $content, $target);
    $this->append($menuLink);
    return $menuLink;
  }

  public function appendText($text): MenuLabel {
    if (!($text instanceof MenuLabel)) {
      $text = new MenuLabel($text);
    }
    $this->append($text);
    return $text;
  }

  public function appendRuler(Ruler $r = null): Ruler {
    if ($r === null) {
      $r = new Ruler();
    }
    $this->append($r);
    return $r;
  }

  public function contentToString(): string {
    return $this->rootlink . $this->menu;
  }

  public function nested(bool $nested = true) {
    $this->getMenu()->nested($nested);
    return $this;
  }

  public function vertical(bool $vertical = true) {
    $this->getMenu()->vertical($vertical);
    return $this;
  }

  public function isVertical(): bool {
    return $this->getMenu()->isVertical();
  }

  public function setActive(bool $active = true) {
    $this->getMenu()->setActive($active);
    return $this;
  }

  public function isActive(): bool {
    return $this->getMenu()->isActive();
  }

}
