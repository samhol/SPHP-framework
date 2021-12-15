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

use Sphp\Exceptions\InvalidArgumentException;

/**
 * Implements a Foundation framework based menu builder
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/menu.html Foundation Menu
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class MenuBuilder {

  /**
   * @var string 
   */
  private $menuType = FlexibleMenu::class;

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

  public function getLinkBuilder(): MenuLinkBuilder {
    return $this->linkBuilder;
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
   * @param  array $contentData
   * @param  Menu $instance
   * @return Menu
   */
  private function insertIntoMenu(array $contentData, OptionsMenu $instance = null): OptionsMenu {
    if ($instance === null) {
      $instance = new FlexibleMenu();
    }
    foreach ($contentData as $item) {
      if (array_key_exists('link', $item)) {
        $object = $instance->append($this->linkBuilder->parseLink($item));
      } else if (array_key_exists('menu', $item) && array_key_exists('items', $item)) {
        $object = $instance->append($this->buildSub($item));
      } else if (array_key_exists('separator', $item)) {
        $object = $instance->appendText($item['separator']);
      } else if (array_key_exists('ruler', $item)) {
        $object = $instance->appendRuler();
      } else {
        throw new InvalidArgumentException('Invalid Menu data given cannot parse menu item');
      }
      if (array_key_exists('class', $item)) {
        $object->addCssClass($item['class']);
      }
    }
    return $instance;
  }

  /**
   * 
   * 
   * @param  array $linkData
   * @return string
   * @throws InvalidArgumentException
   */
  public function parseSubMenuRootText(array $linkData): string {
    if (!array_key_exists('menu', $linkData)) {
      throw new InvalidArgumentException('Malformed submenu data given');
    }
    $text = '';
    if (array_key_exists('icon', $linkData)) {
      $text .= $linkData['icon'] . ' ';
    }
    $text .= $linkData['menu'];
    return $text;
  }

  /**
   * Builds a new sub menu from given menu data
   * 
   * @param  array $data the menu data
   * @return SubMenu new sub menu
   */
  public function buildSub(array $data): SubMenu {
    $root = $this->parseSubMenuRootText($data);
    $instance = new SubMenu($root);
    $this->buildMenu($data, $instance);
    return $instance;
  }

  /**
   * Builds a new menu from given menu data
   * 
   * @param  array $data the menu data
   * @param  Menu|null $instance
   * @return Menu new menu
   */
  public function buildMenu(array $data = [], OptionsMenu $instance = null): OptionsMenu {
    if ($instance === null) {
      $instance = new $this->menuType();
    }
    if (array_key_exists('items', $data)) {
      $this->insertIntoMenu($data['items'], $instance);
    }
    return $instance;
  }

}
