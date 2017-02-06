<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Core\Path;

/**
 * 
 */
class MenuBuilder {

  private $menuType = Menu::class;
  private $linkBuilder;

  public function __construct(MenuLinkBuilder $linkBuilder = null) {
    if ($linkBuilder === null) {
      $linkBuilder = new MenuLinkBuilder();
    }
   $this->linkBuilder =  $linkBuilder;
  }

  /**
   * 
   * @param  string $target
   * @return self for PHP Method Chaining
   */
  public function setMenuType($target) {
    $this->menuType = $target;
    return $this;
  }


  /**
   * 
   * @param  string $target
   * @return self for PHP Method Chaining
   */
  public function setDefaultTarget($target) {
    $this->linkBuilder->setDefaultTarget($target);
    return $this;
  }


  /**
   * 
   * @param  array $data
   * @param  MenuInterface $instance
   * @return Navigation\Menu
   */
  private function insertIntoMenu(array $data, MenuInterface $instance = null) {
    if ($instance === null) {
      $instance = new Menu();
    }
    foreach ($data as $item) {
      if (array_key_exists('link', $item)) {
        $instance->append($this->linkBuilder->parseLink($item));
      } else if (array_key_exists('menu', $item) && array_key_exists('items', $item)) {
        $instance->append($this->buildSub($item));
      } else if (array_key_exists('separator', $item)) {
        $instance->appendText($item['separator']);
      }
    }
    return $instance;
  }

  /**
   * 
   * @param  array $sub
   * @return SubMenu
   */
  public function buildSub(array $sub) {
    $instance = new SubMenu($sub['menu']);
    $this->buildMenu($sub, $instance);
    return $instance;
  }

  /**
   * 
   * @param  array $data
   * @param  MenuInterface|null $instance
   * @return Menu
   */
  public function buildMenu(array $data, MenuInterface $instance = null) {
    if ($instance === null) {
      $instance = new $this->menuType();
    }
    if (array_key_exists('defaultTarget', $data)) {
      $instance->setDefaultTarget($data['defaultTarget']);
    }
    static::insertIntoMenu($data['items'], $instance);
    return $instance;
  }

}
