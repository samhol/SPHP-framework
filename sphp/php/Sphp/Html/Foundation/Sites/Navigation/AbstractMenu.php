<?php

/**
 * AbstractMenu.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Html\AbstractContainerComponent;
use Sphp\Html\Lists\LiInterface;
use Sphp\Html\Navigation\HyperlinkInterface;
use Sphp\Html\ContainerInterface;
use Sphp\Html\WrappingContainer;

/**
 * Implements a Foundation 6 menu
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-03-11
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractMenu extends AbstractContainerComponent implements MenuInterface, MenuItemInterface {

  private $defaultTarget = '_self';

  /**
   * Constructs a new instance
   * 
   * @param string $tagname
   * @param mixed $content
   */
  public function __construct($tagname, AttributeManager $attrManager = null, ContainerInterface $contentContainer = null) {
    parent::__construct($tagname, $attrManager, $contentContainer);
    $this->cssClasses()->lock('menu');
  }

  /**
   * 
   * @param  string $target
   * @return self for PHP Method Chaining
   */
  public function setDefaultTarget($target) {
    $this->defaultTarget = $target;
    return $this;
  }
  
  public function getDefaultTarget() {
    return $this->defaultTarget;
  }

  /**
   * Appends a menu item object to the menu
   *
   * @param  MenuItemInterface $item
   * @return self for PHP Method Chaining
   */
  public function append(MenuItemInterface $item) {
    $this->getInnerContainer()->append($item);
    return $this;
  }

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
  public function appendLink($href, $content = '', $target = '_self') {
    if ($target === null) {
      $target = $this->getDefaultTarget();
    }
    return $this->append(new MenuLink($href, $content, $target));
  }

  /**
   * Appends a new submenu to the menu structure
   *
   * @param  SubMenu $subMenu
   * @return SubMenu appended submenu
   */
  public function appendSubMenu(SubMenu $subMenu = null) {
    if ($subMenu === null) {
      $subMenu = new SubMenu();
    }
    $this->append($subMenu);
    return $subMenu;
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
   * @inheritdoc
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
   * @inheritdoc
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
   * Sets or unsets the menu as active
   *
   * @param  boolean $active true for activation and false for deactivation
   * @return self for PHP Method Chaining
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

}
