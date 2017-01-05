<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Core\Path;

class Factory {

  protected static function parseHref(array $link) {
    if (array_key_exists('url', $link)) {
      $href = $link['url'];
    } else {
      $href = Path::get()->http();
      if (array_key_exists('page', $link)) {
        $href .= '?page=' . $link['page'];
      }
    }
    return $href;
  }

  protected static function parseTarget(array $link) {
    return array_key_exists('target', $link) ? $link['target'] : '_self';
  }

  /**
   * 
   * @param  array $link
   * @return MenuLink
   */
  public static function createLink(array $link) {
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
  private static function insertIntoMenu(array $data, MenuInterface $instance = null) {
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
   * @param string $root
   * @param array $sub
   * @return SubMenu
   */
  public static function buildSub(array $sub) {
    $instance = new SubMenu($sub['menu']);
    static::insertIntoMenu($sub['items'], $instance);
    return $instance;
  }

  public static function buildMenu(array $data, MenuInterface $instance = null) {
    if ($instance === null) {
      $instance = new Menu();
    }
    static::insertIntoMenu($data['items'], $instance);
    return $instance;
  }

}
