<?php

/**
 * AbstractMenu.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Html\AbstractComponent;
use Sphp\Html\ContainerInterface;
use Sphp\Html\Container;

/**
 * Implements an abstract menu
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-03-11
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/menu.html Foundation Menu
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class AbstractMenu extends AbstractComponent implements MenuInterface, MenuItemInterface {

  private $defaultTarget = '_self';

  /**
   *
   * @var ContainerInterface 
   */
  private $items;

  /**
   * Constructs a new instance
   * 
   * @param string $tagname
   * @param AttributeManager $attrManager
   * @param ContainerInterface $contentContainer
   */
  public function __construct($tagname, AttributeManager $attrManager = null, ContainerInterface $contentContainer = null) {
    if ($contentContainer === null) {
      $contentContainer = new Container();
    }
    $this->items = $contentContainer;
    parent::__construct($tagname, $attrManager);
    $this->cssClasses()->lock('menu');
  }

  /**
   * {@inheritdoc}
   */
  public function __destruct() {
    unset($this->items);
    parent::__destruct();
  }

  /**
   * {@inheritdoc}
   */
  public function __clone() {
    $this->items = clone $this->items;
    parent::__clone();
  }

  /**
   * 
   * @param  string $target
   * @return self for a fluent interface
   */
  public function setDefaultTarget($target) {
    $this->defaultTarget = $target;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getDefaultTarget() {
    return $this->defaultTarget;
  }

  /**
   * Appends a menu item object to the menu
   *
   * @param  MenuItemInterface $item
   * @return self for a fluent interface
   */
  public function append(MenuItemInterface $item) {
    $this->items->append($item);
    return $this;
  }

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
  public function appendLink($href, $content = '', $target = '_self') {
    if ($target === null) {
      $target = $this->getDefaultTarget();
    }
    return $this->append(new MenuLink($href, $content, $target));
  }

  /**
   * Appends a new sub menu to the menu structure
   *
   * @param  SubMenu $subMenu
   * @return SubMenu appended sub menu
   */
  public function appendSubMenu(SubMenu $subMenu = null) {
    if ($subMenu === null) {
      $subMenu = new SubMenu();
    }
    $this->append($subMenu);
    return $subMenu;
  }

  /**
   * Appends a menu label text component to the menu
   *
   * @param  mixed|MenuLabel $text 
   * @return self for a fluent interface
   */
  public function appendText($text) {
    if (!($text instanceof MenuLabel)) {
      $text = new MenuLabel($text);
    }
    $this->append($text);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function nested($nested = true) {
    if ($nested) {
      $this->cssClasses()->add('nested');
    } else {
      $this->cssClasses()->remove('nested');
    }
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function vertical($vertical = true) {
    if ($vertical) {
      $this->cssClasses()->add('vertical');
    } else {
      $this->cssClasses()->remove('vertical');
    }
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isVertical() {
    return $this->cssClasses()->contains('vertical');
  }

  /**
   * Sets or unsets the menu as active
   *
   * @param  boolean $active true for activation and false for deactivation
   * @return self for a fluent interface
   */
  public function setActive($active = true) {
    if ($active) {
      $this->addCssClass('is-active');
    } else {
      $this->removeCssClass('is-active');
    }
    return $this;
  }

  /**
   * Checks whether the menu is set as active or not
   *
   * @return boolean true if the hyperlink component is set as active, otherwise false
   */
  public function isActive() {
    return $this->hasCssClass('is-active');
  }

  /**
   * {@inheritdoc}
   */
  public function contentToString() {
    return $this->items->getHtml();
  }

}
