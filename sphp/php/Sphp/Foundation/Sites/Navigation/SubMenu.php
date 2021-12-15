<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Foundation\Sites\Navigation;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Navigation\A;

/**
 * Implements a Foundation navigation submenu
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/ Foundation for Sites
 * @link    https://foundation.zurb.com/sites/docs/menu.html Foundation menus
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class SubMenu extends AbstractComponent implements MenuItem, OptionsMenu {

  /**
   * The root component
   *
   * @var A
   */
  private $rootlink;

  /**
   * @var Menu
   */
  private $menu;

  /**
   * Constructor
   *
   * @param null|string|A $root root content
   * @param Menu $menu
   */
  public function __construct($root = null, OptionsMenu $menu = null) {
    if ($menu === null) {
      $this->menu = new FlexibleMenu();
    }
    parent::__construct('li');
    $this->setRoot($root);
  }

  public function __destruct() {
    unset($this->menu, $this->rootlink);
    parent::__destruct();
  }


  /**
   * Sets the root component of the menu
   *
   * @param string|A $root root content
   * @return $this for a fluent interface
   */
  public function setRoot($root) {
    if ($root instanceof A) {
      $this->rootlink = $root;
    } else {
      $this->rootlink = new A('#', $root);
    }
    return $this;
  }

  /**
   * 
   * @return Menu
   */
  public function getMenu(): OptionsMenu {
    return $this->menu;
  }

  public function append(MenuItem $item): MenuItem {
    if ($item instanceof SubMenu) {
      $item->setVertical($this->isVertical());
    }
    $this->menu->append($item);
    if ($item instanceof MenuLink && $item->isActive()) {
      $this->setActive(true);
    }
    return $item;
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

  public function setVertical(bool $vertical = true) {
    $this->getMenu()->setVertical($vertical);
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
