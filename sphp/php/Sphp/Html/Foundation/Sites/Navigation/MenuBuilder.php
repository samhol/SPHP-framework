<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Core\Path;

/**
 * 
 */
class MenuBuilder {

  private $defaultTarget = '_self';
  private $menuType = Menu::class;

  public function __construct() {
    ;
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
    $this->defaultTarget = $target;
    return $this;
  }

  public function getDefaultTarget() {
    return $this->defaultTarget;
  }

  protected function parseHref(array $link) {
    if (array_key_exists('href', $link)) {
      $href = $link['href'];
    } else {
      $href = Path::get()->http();
      if (array_key_exists('page', $link)) {
        $href .= '?page=' . $link['page'];
      }
    }
    return $href;
  }

  protected function parseTarget(array $link) {
    return array_key_exists('target', $link) ? $link['target'] : $this->getDefaultTarget();
  }

  /**
   * 
   * @param  array $link
   * @return MenuLink
   */
  public function createLink(array $link) {
    $href = static::parseHref($link);
    $target = static::parseTarget($link);
    return new MenuLink($href, $link['link'], $target);
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
        $instance->append(static::createLink($item));
      } else if (array_key_exists('menu', $item) && array_key_exists('items', $item)) {
        $instance->append(static::buildSub($item));
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
    static::buildMenu($sub, $instance);
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
