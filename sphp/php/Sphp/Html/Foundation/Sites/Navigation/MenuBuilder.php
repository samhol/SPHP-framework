<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

/**
 * Implements a Foundation framework based menu builder
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/menu.html Foundation Menu
 * @license https://opensource.org/licenses/MIT The MIT License
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
   * Constructor
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
   * @param  string|null $target
   * @return $this for a fluent interface
   */
  public function setDefaultTarget(string $target = null) {
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
   * Builds a new sub menu from given menu data
   * 
   * @param  array $data the menu data
   * @return SubMenu new sub menu
   */
  public function buildSub(array $data): SubMenu {
    $instance = new SubMenu($data['menu']);
    $this->buildMenu($data, $instance);
    return $instance;
  }

  /**
   * Builds a new menu from given menu data
   * 
   * @param  array $data the menu data
   * @param  MenuInterface|null $instance
   * @return MenuInterface new menu
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
   * Builds a new drop down menu from given menu data
   * 
   * @param  array $data the menu data
   * @return DropdownMenu new menu instance
   */
  public function buildDropdownMenu(array $data): DropdownMenu {
    return $this->buildMenu($data, new DropdownMenu());
  }

  /**
   * Builds a new accordion menu from given menu data
   * 
   * @param  array $data the menu data
   * @return AccordionMenu new menu instance
   */
  public function buildAccordionMenu(array $data): AccordionMenu {
    return $this->buildMenu($data, new AccordionMenu());
  }

}
