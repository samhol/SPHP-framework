<?php

/**
 * MenuBuilder.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

/**
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/menu.html Foundation Menu
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class MenuBuilder {

  /**
   * @var string 
   */
  private $menuType = Menu::class;

  /**
   * @var MenuLinkBuilder 
   */
  private $linkBuilder;

  /**
   * 
   * @param MenuLinkBuilder $linkBuilder
   */
  public function __construct(MenuLinkBuilder $linkBuilder = null) {
    if ($linkBuilder === null) {
      $linkBuilder = new MenuLinkBuilder();
    }
    $this->linkBuilder = $linkBuilder;
  }

  /**
   * 
   * @param  string $menuType
   * @return $this for a fluent interface
   */
  public function setMenuType(string $menuType) {
    $this->menuType = $menuType;
    return $this;
  }

  /**
   * 
   * @param  string $target
   * @return $this for a fluent interface
   */
  public function setDefaultTarget($target) {
    $this->linkBuilder->setDefaultTarget($target);
    return $this;
  }

  /**
   * 
   * @param  array $contentData
   * @param  MenuInterface $instance
   * @return MenuInterface
   */
  private function insertIntoMenu(array $contentData, MenuInterface $instance = null): MenuInterface {
    if ($instance === null) {
      $instance = new Menu();
    }
    foreach ($contentData as $item) {
      if (array_key_exists('link', $item)) {
        $instance->append($this->linkBuilder->parseLink($item));
      } else if (array_key_exists('menu', $item) && array_key_exists('items', $item)) {
        $instance->append($this->buildSub($item));
      } else if (array_key_exists('separator', $item)) {
        $instance->appendText($item['separator']);
      } else if (array_key_exists('ruler', $item)) {
        $instance->appendRuler();
      }
    }
    return $instance;
  }

  /**
   * 
   * @param  array $sub
   * @return SubMenu
   */
  public function buildSub(array $sub): SubMenu {
    $instance = new SubMenu($sub['menu']);
    $this->buildMenu($sub, $instance);
    return $instance;
  }

  /**
   * 
   * @param  array $data
   * @param  MenuInterface|null $instance
   * @return MenuInterface
   */
  public function buildMenu(array $data, MenuInterface $instance = null): MenuInterface {
    if ($instance === null) {
      $instance = new $this->menuType();
    }
    if (array_key_exists('defaultTarget', $data)) {
      $instance->setDefaultTarget($data['defaultTarget']);
    }
    $this->insertIntoMenu($data['items'], $instance);
    return $instance;
  }

  /**
   * 
   * @param  array $data
   * @return DropdownMenu new menu instance
   */
  public function buildDropdownMenu(array $data): DropdownMenu {
    return $this->buildMenu($data, new DropdownMenu());
  }

  /**
   * 
   * @param  array $data
   * @return AccordionMenu new menu instance
   */
  public function buildAccordionMenu(array $data): AccordionMenu {
    return $this->buildMenu($data, new AccordionMenu());
  }

}
