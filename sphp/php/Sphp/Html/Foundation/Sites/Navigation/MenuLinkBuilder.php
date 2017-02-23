<?php

/**
 * URL.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Stdlib\Path;

/**
 * Description of MenuLinkBuilder
 *
 * @author Sami
 */
class MenuLinkBuilder {

  private $defaultTarget = null;
  private $currentPage;
  private $activator;
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

  public function getCurrentPage() {
    return $this->currentPage;
  }

  public function setCurrentPage($currentPage) {
    $this->currentPage = $currentPage;
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

  public function getActivator() {
    return $this->activator;
  }

  public function setActivator($activator) {
    $this->activator = $activator;
    return $this;
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
