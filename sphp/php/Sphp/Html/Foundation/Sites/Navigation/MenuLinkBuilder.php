<?php

/**
 * MenuLinkBuilder.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Stdlib\Path;

/**
 * Description of MenuLinkBuilder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-03-11
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/menu.html Foundation Menu
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class MenuLinkBuilder {

  /**
   *
   * @var type 
   */
  private $defaultTarget = null;

  /**
   *
   * @var type 
   */
  private $currentPage;

  /**
   *
   * @var callable|null 
   */
  private $activator;

  /**
   *
   * @var string 
   */
  private $menuType = Menu::class;

  public function __construct() {
    ;
  }

  /**
   * 
   * @param  string $target
   * @return self for a fluent interface
   */
  public function setMenuType($target) {
    $this->menuType = $target;
    return $this;
  }

  /**
   * 
   * @return type
   */
  public function getCurrentPage() {
    return $this->currentPage;
  }

  /**
   * 
   * @param type $currentPage
   * @return $this
   */
  public function setCurrentPage($currentPage) {
    $this->currentPage = $currentPage;
    return $this;
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
   * 
   * @return string
   */
  public function getDefaultTarget() {
    return $this->defaultTarget;
  }

  public function getActivator() {
    return $this->activator;
  }

  /**
   * 
   * @param type $activator
   * @return $this
   */
  public function setActivator($activator) {
    $this->activator = $activator;
    return $this;
  }

  /**
   * 
   * @param  array $linkData
   * @return string
   */
  protected function parseHref(array $linkData) {
    if (array_key_exists('href', $linkData)) {
      $href = $linkData['href'];
    } else {
      $href = Path::get()->http();
      if (array_key_exists('page', $linkData)) {
        $href .= '?page=' . $linkData['page'];
      }
    }
    return $href;
  }

  /**
   * 
   * @param array $linkData
   * @return string
   */
  protected function parseTarget(array $linkData) {
    return array_key_exists('target', $linkData) ? $linkData['target'] : $this->getDefaultTarget();
  }

  /**
   * 
   * @param  array $linkData
   * @return MenuLink
   */
  public function parseLink(array $linkData) {
    $href = $this->parseHref($linkData);
    $target = $this->parseTarget($linkData);
    $link = new MenuLink($href, $linkData['link'], $target);
    if (is_callable($this->activator)) {
      $t = $this->getActivator();
      $link->setActive($t($linkData));
    }
    return $link;
  }

}
