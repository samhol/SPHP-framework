<?php

/**
 * SubMenu.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Navigation;

use Sphp\Html\AbstractContainerTag as AbstractContainerTag;
use Sphp\Html\Navigation\Hyperlink as Hyperlink;

/**
 * Class implements a submenu for Foundation 6 menus
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-03-11
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/sites/docs/menu.html Foundation 6 menus
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SubMenu extends AbstractContainerTag implements MenuItemInterface, MenuInterface {

  /**
   * The root component
   *
   * @var Hyperlink
   */
  private $rootlink;

  /**
   * Constructs a new instance
   *
   * @param null|string|Hyperlink $root root content
   * @param null|Menu $menu
   */
  public function __construct($root = null, AbstractMenu $menu = NULL) {
    if ($menu === null) {
      $menu = new Menu();
    }
    parent::__construct("li", null, $menu);
    $this->setRoot($root);
    $this->cssClasses()->add("is-dropdown-submenu-parent");
  }

  /**
   * Sets the root component of the menu
   *
   * @param string|Hyperlink $root root content
   * @return self for PHP Method Chaining
   */
  public function setRoot($root) {
    if ($root instanceof Hyperlink) {
      $this->rootlink = $root;
    } else {
      $this->rootlink = new Hyperlink("", $root);
    }
    return $this;
  }

  /**
   * 
   * @param  Menu $menu
   * @return self for PHP Method Chaining
   */
  public function setMenu(Menu $menu) {
    $this->setContentContainer($menu);
    return $this;
  }

  /**
   * 
   * @return Menu
   */
  public function getMenu() {
    return $this->content();
  }

  /**
   * Appends {@link MenuLink} link object to the menu
   *
   * @param  string|URL $href the URL of the link
   * @param  mixed $content link content
   * @param  string $target the value of the target attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function appendLink($href, $content = "", $target = "_self") {
    $menuLink = new MenuLink($href, $content, $target);
    if ($menuLink->isActive()) {
      $this->setActive(true);
    }
    return $this->append($menuLink);
  }

  /**
   * Appends a {@link MenuLabel} text component to the menu
   *
   * @param  mixed|MenuLabel $text
   * @return self for PHP Method Chaining
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
  public function contentToString() {
    return $this->rootlink . parent::contentToString();
  }

  /**
   * {@inheritdoc}
   */
  public function nested($nested = true) {
    $this->getMenu()->nested($nested);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function vertical($vertical = true) {
    $this->getMenu()->vertical($vertical);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setActive($active = true) {
    $this->getMenu()->setActive($active);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isActive() {
    return $this->getMenu()->isActive();
  }

}
