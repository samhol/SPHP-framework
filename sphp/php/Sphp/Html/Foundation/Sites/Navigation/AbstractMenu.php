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
use Sphp\Html\Container;
use Sphp\Html\PlainContainer;

/**
 * Implements an abstract menu
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/menu.html Foundation Menu
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class AbstractMenu extends AbstractComponent implements Menu, MenuItem {

  /**
   * @var Container
   */
  private $items;

  /**
   * Constructor
   * 
   * @param string $tagname
   * @param AttributeManager $attrManager
   * @param Container $contentContainer
   */
  public function __construct(string $tagname, AttributeManager $attrManager = null, Container $contentContainer = null) {
    if ($contentContainer === null) {
      $contentContainer = new PlainContainer();
    }
    $this->items = $contentContainer;
    parent::__construct($tagname, $attrManager);
    $this->cssClasses()->protectValue('menu');
  }

  public function __destruct() {
    unset($this->items);
    parent::__destruct();
  }

  public function __clone() {
    $this->items = clone $this->items;
    parent::__clone();
  }

  /**
   * Appends a menu item object to the menu
   *
   * @param  MenuItem $item
   * @return $this for a fluent interface
   */
  public function append(MenuItem $item) {
    $this->items->append($item);
    return $this;
  }

  public function appendLink(string $href, string $content = '', string $target = null): MenuLink {
    $menu = new MenuLink($href, $content, $target);
    $this->append($menu);
    return $menu;
  }

  /**
   * Appends a new sub menu to the menu structure
   *
   * @param  SubMenu $subMenu
   * @return SubMenu appended sub menu
   */
  public function appendSubMenu(SubMenu $subMenu = null): SubMenu {
    if ($subMenu === null) {
      $subMenu = new SubMenu();
    }
    $this->append($subMenu);
    return $subMenu;
  }

  public function appendText($text): MenuLabel {
    if (!$text instanceof MenuLabel) {
      $text = new MenuLabel($text);
    }
    $this->append($text);
    return $text;
  }

  public function appendRuler(Ruler $r = null): Ruler {
    if ($r === null) {
      $r = new Ruler;
    }
    $this->append(new Ruler);
    return $r;
  }

  public function nested(bool $nested = true) {
    if ($nested) {
      $this->cssClasses()->add('nested');
    } else {
      $this->cssClasses()->remove('nested');
    }
    return $this;
  }

  public function setVertical(bool $vertical = true) {
    if ($vertical) {
      $this->cssClasses()->add('vertical');
    } else {
      $this->cssClasses()->remove('vertical');
    }
    return $this;
  }

  public function isVertical(): bool {
    return $this->cssClasses()->contains('vertical');
  }

  public function setActive(bool $active = true) {
    if ($active) {
      $this->addCssClass('is-active');
    } else {
      $this->removeCssClass('is-active');
    }
    return $this;
  }

  public function isActive(): bool {
    return $this->hasCssClass('is-active');
  }

  public function contentToString(): string {
    return $this->items->getHtml();
  }

}
